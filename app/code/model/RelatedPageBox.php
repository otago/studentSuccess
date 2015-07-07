<?php

class RelatedPageBox extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar(255)',
		'LinkButton'	=> 'Varchar(255)',
		'Icon'			=> 'Varchar(255)',
		'SortOrder'		=> 'Int',
		'SecondaryTarget' => 'Enum("_self,_blank,_modal")',
		'SecondaryLinkURL' => 'Varchar(255)'
	);

	private static $has_one = array(
		'Page'			=> 'Page',
		'SecondaryPageLink' => 'SiteTree'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'Page',
			'PageID',
			'Icon',
			'SecondaryLinkURL'
		));

		// $fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));
		$fields->removeByName('LinkButton');
		$fields->removeByName('SecondaryPageLinkID');
		$fields->removeByName('SecondaryTarget');

		$fields->addFieldsToTab('Root.Main', array(
			new HeaderField('SecondaryLinkHeading', 'Secondary Link'),
			new TextField('LinkButton', 'Link Title'),
			new DropdownField('SecondaryTarget', 'Target', array(
				'_self' => 'Open in same window',
				'_blank' => 'Open in new window',
				'_modal' => 'Modal Window'
			)),
			new TreeDropdownField('SecondaryPageLinkID', 'Link Page', 'SiteTree'),
			new TextField('SecondaryLinkURL')
		));

		return $fields;
	}

} 