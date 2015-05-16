<?php

class CheckListCollection extends CheckListItem {

	private static $has_many = array(
		'ListCollectionItems'		=> 'ListCollectionItem'
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