<?php

class CTAElement extends BaseElement {

	private static $title = "Call To Action Element";

	private static $description = "Call To Action Element";

	private static $db = array(
		'DisplayTitle'		=> 'Varchar',
		'Color'				=> 'Varchar',
		'Icon'				=> 'Varchar',
		'ButtonText'		=> 'Varchar',
		'CTAContent'		=> 'Text',
	);

	private static $has_one = array(
		'Image'				=> 'Image'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->replaceField('Color', DropdownField::create('Color')->setSource(array(
			'orange'		=> 'Orange (Default)',
			'black'			=> 'Black'
		)));
		$fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));

		$fields->dataFieldByName('CTAContent')->setTitle('Content');

		return $fields;
	}
} 