<?php

namespace OP\studentsuccess;

use FormUtils;
use OP\studentsuccess\ListCollectionItem;



class CheckListCollection extends CheckListItem {

	private static $has_many = array(
		'ListCollectionItems'		=> ListCollectionItem::class
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('Content');
		$fields->removeByName('ListCollectionItems');

		$fields->addFieldsToTab('Root.Main', array(
			FormUtils::MakeDragAndDropGridField('ListCollectionItems', 'Items', $this->ListCollectionItems(), 'SortOrder')
		));

		return $fields;
	}

} 