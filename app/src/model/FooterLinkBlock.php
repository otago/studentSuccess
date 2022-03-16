<?php

namespace OP\studentsuccess;


use FormUtils;
use OP\studentsuccess\FooterLink;
use SilverStripe\ORM\DataObject;




class FooterLinkBlock extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'SortOrder'		=> 'Int'
	);

	private static $has_many = array(
		'Links'			=> FooterLink::class
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'Links'
		));

		$fields->addFieldsToTab('Root.Links', array(
			FormUtils::MakeDragAndDropGridField('Links', 'Links', $this->Links(), 'SortOrder')
		));

		return $fields;
	}

} 