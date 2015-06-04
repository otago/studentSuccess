<?php

class LinksComponent extends BaseElement {

	private static $title = "Group of links";
	
	private static $description = "Shows a list of links";

	private static $db = array(
		'DisplayTitle'		=> 'Varchar(300)',
		'Icon'				=> 'Varchar',
		'Color'				=> 'Varchar'
	);

	private static $has_one = array(
		'Image'				=> 'Image'
	);

	private static $many_many = array(
		'Links'				=> 'LinkElement'
	);

	private static $many_many_extraFields = array(
		'Links'				=> array(
			'SortOrder'		=> 'Int'
		)
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->removeByName('Links');

		$fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));
		$fields->replaceField('Color', DropdownField::create('Color')->setSource(array(
			'blue'		=> 'Blue (Default)',
			'red'		=> 'Red',
			'green'		=> 'Green'
		)));

		if($this->ID){
			$fields->addFieldToTab('Root.Main', FormUtils::MakeDragAndDropGridField('Links', 'Links', $this->OrderedLinks(), 'SortOrder', 'RecordEditor'));
		}

		return $fields;
	}

	public function OrderedLinks(){
		return $this->Links()->sort('SortOrder');
	}



} 