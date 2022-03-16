<?php

namespace OP\studentsuccess;


use OP\studentsuccess\MasonryTileLink;
use OP\studentsuccess\FormUtils;




class LinkListMasonryTile extends MasonryTile {

	private static $has_many = array(
		'Links'			=> MasonryTileLink::class
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'Content'
		));

		$fields->addFieldToTab('Root.Main', 
			FormUtils::MakeDragAndDropGridField('Links', 'Links', $this->Links(), 'SortOrder', 'RecordEditor')
		);

		return $fields;

	}
} 