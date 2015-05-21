<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 4/6/15
 * Time: 8:53 AM
 * To change this template use File | Settings | File Templates.
 */

class Page extends SiteTree {

	private static $db = array(
		'MetaTitle'		=> 'Varchar(255)',
		'Intro'				=> 'Text',
	);

	public function canView($member = null) {
		if($this->URLSegment == 'SearchPage') {
			return true;
		}

		return parent::canView($member);
	}

	function canViewStage($stage = 'Live', $member = null){
		if($this->URLSegment == 'SearchPage')
			return true;

		return parent::canViewStage($stage, $member);
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$metaData = $fields->fieldByName('Root.Main.Metadata');

		if($metaData) {
			$metaData->push(new TextField('MetaTitle', 'Meta title'));
		}
		else{
			$fields->addFieldToTab("Root.Main", new TextField('MetaTitle', 'Meta title'));
		}

		$fields->insertAfter(new TextField('Intro', 'Page Intro'), 'URLSegment');

		$this->extend('updateCMSFieldsForImages', $fields);

		return $fields;
	}


}

class Page_Controller extends ContentController {

	function Content(){
		return ShortCodeUtils::ParseShortCodes($this->Content);
	}

	function Year(){
		return date('Y', strtotime(SS_Datetime::now()));
	}

}