<?php

class CheckListItem extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar(255)',
		'Content'		=> 'HTMLText',
		'UseArrow'		=> 'Boolean',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'CheckList'		=> 'CheckList'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'CheckList',
			'CheckListID',
			'UseArrow'
		));

		$parent = $this->CheckList();

		if($parent->exists()) {
			if($parent instanceof SingleLevelChecklist || $parent instanceof SingleLevelList) {
				$fields->removeByName('Content');
			} 
		} else {
			$fields->removeByName('Content');
		}

		$fields->removeByName('UseArrow');

		return $fields;
	}


	public function getUseArrow() {
		if($parent = $this->CheckList()) {
			return ($parent instanceof SingleLevelList || $parent instanceof InteractiveList);
		}

		return false;
	}
} 