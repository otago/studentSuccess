<?php

class FilterableSmallMasonryTile extends SmallMasonryTile {

	private static $db = array();

	private static $belongs_many_many = array(
		'LinkLists' => 'MasonryTileLink'
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName('Content');

		return $fields;
	}
} 