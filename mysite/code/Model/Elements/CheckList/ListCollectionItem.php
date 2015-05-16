<?php

class ListCollectionItem extends DataObject {

	private static $db = array(
		'Icon'			=> 'Varchar',
		'Content'		=> 'Text',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'CheckListCollection'	=> 'CheckListCollection'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'CheckListCollectionID',
			'CheckListCollection',
			'SortOrder'
		));

		$fields->replaceField('Icon', DropdownField::create('Icon')->setSource(array(
			'icon-tick'		=> 'Tick',
			'icon-dot'		=> 'Dot'
		)));

		return $fields;
	}

} 