<?php

class SmallMasonryTile extends MasonryTile {

	private static $db = array(
		'LinkButton'		=> 'Varchar',
		'SecondaryTarget' => 'Enum("_self,_blank,_modal")'
	);

	private static $field_labels = array(
		'LinkButton' => 'Secondary Link Title'
	);

	private static $has_one = array(
		'SecondaryPageLink' => 'SiteTree'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Content');

		$fields->removeByName('LinkButton');
		$fields->removeByName('SecondaryPageLinkID');
		$fields->removeByName('SecondaryTarget');

		$fields->addFieldsToTab('Root.Main', array(
			new HeaderField('SecondaryLinkHeading', 'Secondary Link'),
			new TextField('LinkButton', 'Link Title'),
			new DropdownField('SecondaryTarget', 'Target', $this->dbObject('SecondaryTarget')->enumValues()),
			new TreeDropdownField('SecondaryPageLinkID', 'Link Page', 'SiteTree')
		));

		return $fields;
	}

} 