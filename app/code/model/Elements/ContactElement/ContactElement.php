<?php

class ContactElement extends BaseElement {

	private static $title = "Contact Element";

	private static $description = "Contact Element";

	private static $db = array(
		'FirstName'		=> 'Varchar',
		'LastName'		=> 'Varchar',
		'DescriptionText'		=> 'Text',
		'email'		=> 'Varchar',
		'Phone'		=> 'Varchar',
		'imageType'		=> 'Varchar',
		
		'backgroundColour'		=> 'Varchar',
	);

	private static $has_one = array(
		'Image'				=> 'Image'
	);


	public function getCMSFields(){

		$fields = parent::getCMSFields();

		$fields->replaceField('imageType', DropdownField::create('imageType')->setSource(array(
			'Circle'		=> 'Circle',
			'Square'			=> 'Square'
		)));
		$fields->replaceField('backgroundColour', DropdownField::create('backgroundColour')->setSource(array(
			'bgGrey'			=> 'Grey',
			'bgWhite'		=> 'White'
		)));
/*		
		$fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));
*/
		return $fields;
	}
} 