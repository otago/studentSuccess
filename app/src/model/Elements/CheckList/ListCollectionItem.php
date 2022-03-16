<?php

namespace OP\studentsuccess;


use OP\studentsuccess\CheckListCollection;
use SilverStripe\ORM\DataObject;



class ListCollectionItem extends DataObject {

	private static $db = array(
		'Content'		=> 'Text',
		'SortOrder'		=> 'Int'
	);

	private static $summary_fields = array(
		'Content'
	);

	private static $has_one = array(
		'CheckListCollection'	=> CheckListCollection::class
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'CheckListCollectionID',
			CheckListCollection::class,
			'SortOrder'
		));

		return $fields;
	}

} 