<?php

class FilterableSmallMasonryTile extends SmallMasonryTile {

	private static $db = array();

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName('Content');

		return $fields;
	}
} 