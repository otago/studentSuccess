<?php

class MasonryTileLink extends DataObject {

	private static $db = array(
		'Title'					=> 'Varchar',
		'SortOrder'				=> 'Int'
 	);

	private static $has_one = array(
		'LinkListMasonryTile'	=> 'LinkListMasonryTile'
	);

	private static $many_many = array(
		'Elements' => 'FilterableSmallMasonryTile'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'LinkListMasonryTile',
			'LinkListMasonryTileID',
			'SortOrder',
			'Elements'
		));

		if($this->LinkListMasonryTile()->exists()) {
			$tiles = FilterableSmallMasonryTile::get()
				->filter('MasonryContentID', $this->LinkListMasonryTile()->MasonryContentID);
				
			$fields->addFieldToTab('Root.Main', new CheckboxSetField('Elements', 'Elements', $tiles));
		}

		return $fields;
	}

} 