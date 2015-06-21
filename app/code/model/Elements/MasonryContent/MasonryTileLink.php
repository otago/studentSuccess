<?php

class MasonryTileLink extends DataObject {

	private static $db = array(
		'Title'					=> 'Varchar',
		'SearchFilter'			=> 'Boolean',
		'SortOrder'				=> 'Int'
 	);

	private static $has_one = array(
		'LinkListMasonryTile'	=> 'LinkListMasonryTile'
	);

	private static $field_labels = array(
		'SearchFilter' => 'If filtering the same page'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'LinkListMasonryTile',
			'LinkListMasonryTileID',
			'SortOrder'
		));

		return $fields;
	}

} 