<?php

class ListCollectionItem extends DataObject {

	private static $db = array(
		'Content'		=> 'Text',
		'SortOrder'		=> 'Int'
	);

	private static $summary_fields = array(
		'Content'
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

		return $fields;
	}

} 