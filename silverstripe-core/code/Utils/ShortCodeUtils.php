<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 4/6/15
 * Time: 8:57 AM
 * To change this template use File | Settings | File Templates.
 */

class ShortCodeUtils {

	private static $codes = array(
		'DIV'			=> 'div',
		'SECTION'		=> 'section',
		'HEADER'		=> 'header',
		'FOOTER'		=> 'footer',
		'COL'			=> array(
			'Start'		=> 'div class="col"',
			'End'		=> 'div'
		)
	);

	public static function AddShortCode($strCode, $arrParser){
		self::$codes[$strCode] = $arrParser;
	}


	public static function StartHTMLBlock($oParser){
		if(is_array($oParser) && isset($oParser['Start']))
			return $oParser['Start'];

		return $oParser;

	}

	public static function EndHTMLBlock($oParser){
		if(is_array($oParser) && isset($oParser['End']))
			return $oParser['End'];

		return $oParser;
	}

	public static function ParseShortCodes($strText){

		$codes = Config::inst()->get('ShortCodeUtils', 'codes');

		// clean all the <p> tags added around short codes
		foreach($codes as $strCode => $oParser){
			$strText = str_replace("<p>[{$strCode}", "[$strCode", $strText);
			$strText = str_replace("<p>[/{$strCode}]", "[/{$strCode}]", $strText);
			$strText = str_replace("{$strCode}]</p>", "{$strCode}]", $strText);
		}


		foreach($codes as $strCode => $oParser){
			$strStart = self::StartHTMLBlock($oParser);
			$strEnd = self::EndHTMLBlock($oParser);

			// check for self closing tags
			while($selfClosing = preg_match('/\[' . $strCode  . '.*?\/\]/', $strText, $arrMatches)){
				if(count($arrMatches)) foreach($arrMatches as $strReplace){
					$strHTML = str_replace('[' . $strCode, '<' . $strStart, $strReplace);
					$strHTML = str_replace('/]', '></' . $strEnd . '>', $strHTML);
					$strText = str_replace($strReplace, $strHTML, $strText);
				}
			}

			$strText = str_replace('[' . $strCode, '<' . $strStart, $strText);
			$strText = str_replace('[/' . $strCode . ']', '</' . $strEnd  . '>', $strText);
		}


		$parser = new ShortcodeParser();
		$parser->register('sitetree_link', array('SiteTree', 'link_shortcode_handler'));
		return $parser->parse($strText);
	}

} 