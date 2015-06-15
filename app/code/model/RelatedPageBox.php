<?php

class RelatedPageBox extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'LinkButton'	=> 'Varchar',
		'Icon'			=> 'Varchar',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'Page'			=> 'Page'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'Page',
			'PageID',
			'Icon'
		));

		// $fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));


		return $fields;
	}

} 