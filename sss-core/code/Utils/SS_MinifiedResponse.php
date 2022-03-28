<?php

namespace OP\Studentsuccess;




use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Core\Extension;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPResponse;


/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 10/24/14
 * Time: 7:00 PM
 * To change this template use File | Settings | File Templates.
 */

class SS_MinifiedResponseExtension extends Extension {


	function onBeforeInit(){
		if(is_a($this->owner, ContentController::class)){
			$this->owner->response = new SS_MinifiedResponse();
		}
	}


}

class SS_MinifiedResponse extends HTTPResponse {



	public function setBody($body) {
		if(Director::isDev()){
			$this->body = $body ? (string)$body : $body;
		}
		else{
			$this->body = $this->html_compress($body ? (string)$body : $body);
		}
	}



	// $data is either a handle to an open file, or an HTML string
	function html_compress($data, $options = null)
	{
		if(!isset($options))
		{
			$options = array();
		}

		$data 			.= "\n";
		$out        = '';
		$inside_pre = false;
		$inside_script = false;
		$inside_style = false;
		$bytecount  = 0;

		while($line = $this->get_line($data))
		{
			$bytecount += strlen($line);

			if(!$inside_pre)
			{
				if(strpos($line, '<pre') === false)
				{
					// Since we're not inside a <pre> block, we can trim both ends of the line
					$line = trim($line);

					// And condense multiple spaces down to one
					$line = preg_replace('/\s\s+/', ' ', $line);
				}
				else
				{
					// Only trim the beginning since we just entered a <pre> block...
					$line = ltrim($line);
					$inside_pre = true;

					// If the <pre> ends on the same line, don't turn on $inside_pre...
					if((strpos($line, '</pre') !== false) && (strripos($line, '</pre') >= strripos($line, '<pre')))
					{
						$line = rtrim($line);
						$inside_pre = false;
					}
				}
			}
			if(!$inside_script){
				if(strpos($line, '<script') !== false){
					$inside_script = true;
				}
				if(strpos($line, '</script') !== false && strripos($line, '</script') >= strripos($line, '<script')){
					$inside_script = false;
				}
			}
			if(!$inside_style){
				if(strpos($line, '<style') !== false){
					$inside_style = true;
				}
				if(strpos($line, '</style') !== false && strripos($line, '</style') >= strripos($line, '<style')){
					$inside_style = false;
				}
			}
			else
			{
				if((strpos($line, '</pre') !== false) && (strripos($line, '</pre') >= strripos($line, '<pre')))
				{
					// Trim the end of the line now that we found the end of the <pre> block...
					$line = rtrim($line);
					$inside_pre = false;
				}
				if(strpos($line, '</script')){
					$inside_script = false;
				}
				if(strpos($line, '</style')){
					$inside_style = false;
				}

			}

			// Filter out any blank lines that aren't inside a <pre> block...
			if($inside_pre || $line != '')
			{
				$out .= $line;
				if($inside_script || $inside_script){
					$out .= "\n";
				}
			}
		}

		// Remove HTML comments...
		if(array_key_exists('c', $options) || array_key_exists('no-comments', $options))
		{
			$out = preg_replace('/(<!--.*?-->)/ms', '', $out);
			$out = str_replace('<!>', '', $out);
		}

		// Perform any extra (unsafe) compression techniques...
		if(array_key_exists('x', $options) || array_key_exists('extra', $options))
		{
			// Can break layouts that are dependent on whitespace between tags
			$out = str_replace(">\n<", '><', $out);
		}

		// Remove the trailing \n
		$out = trim($out);

		// Output either our stats or the compressed data...
		if(array_key_exists('s', $options) || array_key_exists('stats', $options))
		{
			$echo = '';
			$echo .= "Original Size: $bytecount\n";
			$echo .= "Compressed Size: " . strlen($out) . "\n";
			$echo .= "Savings: " . round((1 - strlen($out) / $bytecount) * 100, 2) . "%\n";
			echo $echo;
		}
		else
		{
			if(array_key_exists('o', $options) || array_key_exists('overwrite', $options))
			{
				if($GLOBALS['argc'] > 1 && is_writable($GLOBALS['argv'][$GLOBALS['argc'] - 1]))
				{
					file_put_contents($GLOBALS['argv'][$GLOBALS['argc'] - 1], $out);
					return true;
				}
				else
				{
					return "Error: could not write to " . $GLOBALS['argv'][$GLOBALS['argc'] - 1] . "\n";
				}
			}
			else
			{
				return $out;
			}
		}
	}

	// Returns the next line from an open file handle or a string
	function get_line(&$data)
	{
		if(is_resource($data))
		{
			return fgets($data);
		}

		if(is_string($data))
		{
			if(strlen($data) > 0)
			{
				$pos = strpos($data, "\n");
				$return = substr($data, 0, $pos) . "\n";
				$data = substr($data, $pos + 1);
				return $return;
			}
			else
			{
				return false;
			}
		}

		return false;
	}

} 