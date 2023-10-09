<?php

namespace OP\Studentsuccess;


use SilverStripe\SiteConfig\SiteConfig;


/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 4/6/15
 * Time: 8:57 AM
 * To change this template use File | Settings | File Templates.
 */

class StringUtils {

	/**
	 * @param $dl
	 * @param $strField
	 * @param string $strGlue
	 * @return string
	 */
	public static function GetStrListFromDataList($dl, $strField, $strGlue = ' '){
		$arr = $dl->map($strField, $strField)->toArray();
		if(count($arr))
			return implode($strGlue, $arr);
		return '';
	}

	/**
	 * @param $dl
	 * @param string $strCol
	 * @return int|string
	 */
	public static function GetIDListCSV($dl, $strCol = 'ID'){
		$arr = $dl->map($strCol, $strCol)->toArray();
		return !empty($arr) ? implode(',', $arr) : 0;
	}

	/**
	 * @param $Haystack
	 * @param $Needle
	 * @return bool
	 */
	public static function StartsWith($Haystack, $Needle) {
		return strpos($Haystack, $Needle) === 0;
	}

	/**
	 * @param $strHayStack
	 * @param $strNeedle
	 * @param bool $casesenitive
	 * @return bool
	 */
	public static function Contains($strHayStack, $strNeedle, $caseSensitive=true){
		if ($caseSensitive==false) {
			$strHayStack = strtoupper($strHayStack);
			$strNeedle = strtoupper($strNeedle);
		}
		$ret = false;
		$type=gettype($strNeedle);
		if ($type=='array') {
			foreach ($strNeedle as $strFind) {
				if(strlen($strFind) < 1) continue;
				$pos = strpos($strHayStack,$strFind);
				if ($pos !== false) {
					$ret = true;
				}
			}
		}
		else {
			$pos = strpos($strHayStack,$strNeedle);
			if ($pos !== false) {
				$ret = true;
			}
		}

		return $ret;
	}

	/**
	 * @param $str
	 * @param $strStart
	 * @param $strEnd
	 * @param int $iOffset
	 * @return array|null
	 */
	public static function GetBeforeBetweenAndAfter($str, $strStart, $strEnd, int $iOffset = 0) {
		$iStart = strpos($str, $strStart, $iOffset);
		$iEnd = strpos($str, $strEnd, $iOffset);
		if ($iStart !== false  && $iEnd !== false) {
			$arr = array();
			$arr['Before'] = substr($str,0,$iStart);
			$arr['Between'] = StringUtils::GetBetween($str, $strStart, $strEnd, $iOffset);
			$arr['After'] = substr($str,strlen($arr['Before'].$strStart.$arr['Between'].$strEnd));
			return $arr;
		}
		return null;
	}


	/**
	 * @param $str
	 * @param $strStart
	 * @param $strEnd
	 * @return string
	 */
	public static function GetBetween($str, $strStart, $strEnd) {
		$pos_start = strpos($str, $strStart);
		$pos_end = strpos($str, $strEnd, ($pos_start + strlen($strStart)));
		if (($pos_start !== false) && ($pos_end !== false)) {
			$pos1 = $pos_start + strlen($strStart);
			return substr($str, $pos1, $pos_end - $pos1);
		}
		return '';
	}


	/**
	 * @param $strURL
	 * @return mixed
	 */
	public static function YouTubeVideoIDFromURL($strURL){
		parse_str( parse_url( $strURL, PHP_URL_QUERY ), $arrVars );
		return isset($arrVars['v']) ? $arrVars['v'] : null;
	}

    public static function MoneyNice($fAmount){
        $fAmount = ceil(intval($fAmount * 100));
        $fAmount = $fAmount / 100;
        return SiteConfig::current_site_config()->CurrencySymbol . ' ' . number_format($fAmount, 2);
    }

    /**
	 * @param $status
	 * @param bool $targetBlank
	 * @param int $linkMaxLen
	 * @return mixed
	 */
	static function ConvertTwitterStatusToHTML($status,$targetBlank=true,$linkMaxLen=250){

		// The target
		$target=$targetBlank ? " target=\"_blank\" " : "";

		// convert link to url
		$status = preg_replace("/((http:\/\/|https:\/\/)[^ )]+)/e", "'<a href=\"$1\" title=\"$1\"  $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);

		// convert @ to follow
		$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);

		// convert # to search
		$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"http://search.twitter.com/search?q=%23$2\" title=\"Search $1\" $target >$1</a>",$status);

		// return the status
		return $status;

	}




}
