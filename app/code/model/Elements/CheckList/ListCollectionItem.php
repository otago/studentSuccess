<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 2:30 PM
 * To change this template use File | Settings | File Templates.
 */

class ListCollectionItem extends DataObject {

	private static $db = array(
		'Content'		=> 'Text',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'CheckListCollection'	=> 'CheckListCollection'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'CheckListCollectionID',
			'CheckListCollection',
			'SortOrder'
		));

		return $fields;
	}

} 