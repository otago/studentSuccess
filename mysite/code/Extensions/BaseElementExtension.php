<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 11:10 AM
 * To change this template use File | Settings | File Templates.
 */

class BaseElementExtension extends DataExtension {


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

		$after = BaseElement::get()->filter(array(
			'ParentID'				=> $this->owner->ParentID,
			'ID:not'				=> $this->owner->ID,
			'Sort:GreaterThanOrEqual'	=> $this->owner->Sort
		))->sort('Sort', 'ASC')->first();


		if(($before && in_array($before->ClassName, $arrSidebarClasses)) || ($after && in_array($after->ClassName, $arrSidebarClasses))){
			$bRet = true;
		}

		return $bRet;
	}


} 