<?php

class VideoComponent extends HearFromOthers {
	
	private static $title = "Video";

	private static $description = "Video Component with modal player";
	
	private static $db = array(
		'Color'	=> 'Varchar'
	);
			
	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', DropdownField::create('Color')->setSource(array(
			'green'		=> 'Green',
			'red'		=> 'Red',
			'blue'		=> 'Blue',
			'yellow'	=> 'Yellow'
		)));

		return $fields;
	}
}
