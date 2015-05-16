<?php

class AccordionItem extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'Content'		=> 'HTMLText',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'Accordion'		=> 'Accordion'
	);

	private static $default_sort = 'SortOrder';

	function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'Accordion',
			'AccordionID'
		));

		return $fields;
	}

} 