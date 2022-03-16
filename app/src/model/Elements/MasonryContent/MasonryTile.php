<?php

namespace OP\studentsuccess;


use OP\studentsuccess\MasonryContent;
use SilverStripe\ORM\DataObject;



class MasonryTile extends DataObject {

	private static $db = array(
		'Title'				=> 'Varchar(255)',
		'Content'			=> 'Text',
		'SortOrder'			=> 'Int',
	);

	private static $has_one = array(
		'MasonryContent'	=> MasonryContent::class
	);

	private static $summary_fields = array(
		'Title',
		'ClassName'
	);

	private static $field_labels = array(
		'Title' => 'Heading'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			MasonryContent::class,
			'MasonryContentID'
		));

		return $fields;
	}

	public function Render(){
		return $this->renderWith($this->ClassName);
	}

} 