<?php

class CheckListItem extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
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
			'CheckListID'
		));

		return $fields;
	}

} 