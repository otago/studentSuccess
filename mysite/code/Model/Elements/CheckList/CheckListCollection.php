<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 2:23 PM
 * To change this template use File | Settings | File Templates.
 */

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