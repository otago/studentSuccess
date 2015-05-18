<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 4/6/15
 * Time: 8:57 AM
 * To change this template use File | Settings | File Templates.
 */

class DateUtils {

	/**
	 * @param $dtDateTime
	 * @return bool|string
	 */
	public static function SSDateTimeToPublicDateTime($dtDateTime)
	{
		if(is_a($dtDateTime, "SS_Datetime")){
			$dtDateTime = strtotime($dtDateTime->getValue());
		} elseif(is_string($dtDateTime)){
			$dtDateTime = strtotime($dtDateTime);
		}
		return date(Config::inst()->get('DateUtils', 'PublicDateTimeFormat'), $dtDateTime);
	}

	/**
	 * @param $dtDateTime
	 * @return bool|string
	 */
	public static function SSDateTimeToPublicDate($dtDateTime)
	{
		if(is_a($dtDateTime, "SS_Datetime")){
			$dtDateTime = strtotime($dtDateTime->getValue());
		} elseif(is_string($dtDateTime)){
			$dtDateTime = strtotime($dtDateTime);
		}
		return date(Config::inst()->get('DateUtils', 'PublicDateFormat'), $dtDateTime);
	}

	/**
	 * @param $dtDateTime
	 * @return bool|string
	 */
	public static function SSDateTimeToPublicTime($dtDateTime)
	{
		if(is_a($dtDateTime, "SS_Datetime")){
			$dtDateTime = strtotime($dtDateTime->getValue());
		} elseif(is_string($dtDateTime)){
			$dtDateTime = strtotime($dtDateTime);
		}
		return date(Config::inst()->get('DateUtils', 'PublicTimeFormat'), $dtDateTime);
	}

	/**
	 * @param $dtStarDate
	 * @param $dtEndDate
	 * @return string
	 */
	public static function SSDateTimeToPublicDuration($dtStarDate, $dtEndDate)
	{
		$dtStarDate = strtotime($dtStarDate);
		$dtEndDate = strtotime($dtEndDate);

		if(date('M', $dtStarDate) == date('M', $dtEndDate)){
			return date('d', $dtStarDate). ' - '. date(Config::inst()->get('DateUtils', 'PublicDateFormat'), $dtEndDate);
		} else {
			return date('d F', $dtStarDate). ' - '. date(Config::inst()->get('DateUtils', 'PublicDateFormat'), $dtEndDate);
		}
	}


	/**
	 * @param $dtStartDate
	 * @param $iDays
	 * @return int
	 */
	public static function AddDaysToDate($dtStartDate, $iDays){
		$arrDates = getdate($dtStartDate);
		return mktime(
			$arrDates['hours'],
			$arrDates['minutes'],
			$arrDates['seconds'],
			$arrDates['mon'],
			$arrDates['mday'] + $iDays,
			$arrDates['year']
		);
	}

	/**
	 * @param $dtStartDate
	 * @param $iDays
	 * @return int
	 */
	public static function SubtractDaysFromDate($dtStartDate, $iDays){
		$arrDates = getdate($dtStartDate);
		return mktime(
			$arrDates['hours'],
			$arrDates['minutes'],
			$arrDates['seconds'],
			$arrDates['mon'],
			$arrDates['mday'] - $iDays,
			$arrDates['year']
		);
	}

	/**
	 * @param $dtStartDate
	 * @param $iMonth
	 * @return int
	 */
	public static function AddMonthsToDate($dtStartDate, $iMonth){
		$arrDates = getdate($dtStartDate);
		return mktime(
			$arrDates['hours'],
			$arrDates['minutes'],
			$arrDates['seconds'],
			$arrDates['mon'] + $iMonth,
			$arrDates['mday'],
			$arrDates['year']
		);
	}


	/**
	 * @param $dtStartDate
	 * @param $iHours
	 * @return int
	 */
	public static function AddHoursToDate($dtStartDate, $iHours){
		$arrDates = getdate($dtStartDate);
		return mktime(
			$arrDates['hours'] + $iHours,
			$arrDates['minutes'],
			$arrDates['seconds'],
			$arrDates['mon'],
			$arrDates['mday'],
			$arrDates['year']
		);
	}

	/**
	 * @param $dtDate
	 * @return int
	 */
	public static function FirstDayOfMonth($dtDate) {
		return mktime(0,0,0,date('n',$dtDate),1,date('Y',$dtDate));
	}

	/**
	 * @param $dtDate
	 * @return int
	 */
	public static function LastDayOfMonth($dtDate) {
		return mktime(23,59,59,date('n',$dtDate) + 1, 0,date('Y',$dtDate));
	}

	/**
	 * @param $dtDate
	 * @return int
	 */
	public static function DateToMidnight($dtDate){
		return mktime(0,0,0,date('n',$dtDate), date('d', $dtDate),date('Y',$dtDate));
	}


	/**
	 * @param $dtFrom
	 * @param $dtTo
	 * @return float
	 */
	public static function NumberOfNightsBetween($dtFrom, $dtTo){
		return round(($dtTo - $dtFrom)/86400);
	}


	/**
	 * @param $dtDate
	 * @return bool
	 */
	public static function IsToday($dtDate){
		return self::DateToMidnight($dtDate) == self::DateToMidnight(strtotime(SS_Datetime::now()));
	}


	/**
	 * @param $dtDate
	 * @return bool
	 */
	public static function IsWeekend($dtDate){
		return in_array(date('w', $dtDate), array(0, 6));
	}


	/**
	 * @param $strDate
	 * @return int
	 */
	public static function JSDateToPHPDate($strDate){
		$arrParts = explode('/', $strDate);
		return mktime(0, 0, 0, $arrParts[1], $arrParts[0], $arrParts[2]);
	}


	/**
	 * @param $strDate
	 * @return bool|string
	 */
	public static function JSDateToMYSQLDate($strDate){
		return date('Y-m-d', self::JSDateToPHPDate($strDate));
	}

	/**
	 * @param $dtDate
	 * @return bool|string
	 */
	public static function PHPDateToCalendarDate($dtDate){
		return date('d/m/Y', $dtDate);
	}

	/**
	 * @param $strDate
	 * @return int
	 */
	public static function CalendarDateToPHPDate($strDate){
		$iYear = (int)substr($strDate,6,4);
		$iMonth = (int)substr($strDate,3,2);
		$iDay = (int)substr($strDate,0,2);
		return mktime(0,0,0,$iMonth,$iDay,$iYear);
	}



} 