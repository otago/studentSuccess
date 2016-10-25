<?php

class ReferencesElement extends BaseElement {

	private static $title = "References Element";

	private static $description = "References Element";

	private static $db = array(
		'reference1'		=> 'Text',
		'referenceItalics'		=> 'Text',
		'reference2'		=> 'Text',
		'link'		=> 'Text',

	);


	public function getCMSFields(){

		$fields = parent::getCMSFields();


/*		
		$fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));
*/
		return $fields;
	}
} 