<?php

class SmallMasonryTile extends MasonryTile {

	private static $db = array(
		'LinkButton'		=> 'Varchar'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Content');

		return $fields;
	}

} 