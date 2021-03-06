<?php

class GlossaryItem extends DataObject {

	private static $db = array(
		'Title'				=> 'Varchar(255)',
		'ShowContactInfo'	=> 'Boolean',
		'Content'			=> 'HTMLText',
		'SortOrder'			=> 'Int'
	);

	private static $has_one = array(
		'GlossaryType'		=> 'GlossaryType'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'GlossaryType',
			'GlossaryTypeID'
		));

		return $fields;
	}

} 