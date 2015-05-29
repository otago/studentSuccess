<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 11:10 AM
 * To change this template use File | Settings | File Templates.
 */

class BaseElementExtension extends DataExtension {

	public static $has_open_wrapper = false;

	function HasSidebar() {
		$bRet = false;

		$arrSidebarClasses = array(
			'SidebarShareElement',
			'SidebarTestimony',
			'SidebarImageElement'
		);

		$before = BaseElement::get()->filter(array(
			'ParentID'				=> $this->owner->ParentID,
			'ID:not'				=> $this->owner->ID,
			'Sort:LessThanOrEqual'	=> $this->owner->Sort
		))->sort('Sort', 'DESC')->first();

		if(($before && in_array($before->ClassName, $arrSidebarClasses))) {
			$bRet = true;
		}

		return $bRet;
	}

	function ShouldHaveWrapper() {
		$should = strpos($this->owner->ClassName, 'Sidebar') !== false;

		if($should && !self::$has_open_wrapper) {
			self::$has_open_wrapper = true;

			return true;
		}

		return false;
	}

	function ShouldCloseWrapper() {
		$should = strpos($this->owner->ClassName, 'Sidebar') === false;

		return ($should && self::$has_open_wrapper);
	}
} 