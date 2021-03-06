<?php

class CaseStudy extends BaseElement {

	private static $title = "Case Study";

	private static $description = "Case Study";

	private static $db = array(
		'Color'				=> 'Varchar',
		'Summary'			=> 'Text',
		'CaseStudyContent'	=> 'HTMLText'
	);

	private static $has_one = array(
		'Image'				=> 'Image'
	);

	private static $field_labels = array(
		'Summary' => 'Pull quote'
	);

	protected $enable_title_in_template = true;
	
	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Color');

		$fields->addFieldToTab('Root.Main', DropdownField::create('Color')->setSource(array(
			'green'		=> 'Green',
			'red'		=> 'Red',
			'blue'		=> 'Blue'
		)));

		return $fields;
	}

} 