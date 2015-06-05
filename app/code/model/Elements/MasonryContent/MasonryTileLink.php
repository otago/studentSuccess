<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 10:11 AM
 * To change this template use File | Settings | File Templates.
 */

class MasonryTileLink extends DataObject {

	private static $db = array(
		'Title'					=> 'Varchar',
		'SortOrder'				=> 'Int'
 	);

	private static $has_one = array(
		'LinkListMasonryTile'	=> 'LinkListMasonryTile'
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