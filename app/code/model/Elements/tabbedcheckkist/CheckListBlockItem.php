<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 3:23 PM
 * To change this template use File | Settings | File Templates.
 */

class CheckListBlockItem extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'ShowContacts'	=> 'Boolean',
		'Content'		=> 'HTMLText',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'CheckListBlock'	=> 'CheckListBlock'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'CheckListBlock',
			'CheckListBlockID',
			'SortOrder'
		));

		return $fields;
	}

} 