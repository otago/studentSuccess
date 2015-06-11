<?php

class MasonryTile extends DataObject {

	private static $db = array(
		'Title'				=> 'Varchar',
		'Content'			=> 'Text',
		'SortOrder'			=> 'Int',
	);

	private static $has_one = array(
		'MasonryContent'	=> 'MasonryContent'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'MasonryContent',
			'MasonryContentID'
		));

		return $fields;
	}

	public function Render(){
		return $this->renderWith($this->ClassName);
	}

} 