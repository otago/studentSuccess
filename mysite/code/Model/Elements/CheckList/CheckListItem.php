<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 2:26 PM
 * To change this template use File | Settings | File Templates.
 */

class CheckListItem extends DataObject {

	private static $db = array(
		'Icon'			=> 'Varchar',
		'Title'			=> 'Varchar',
		'Content'		=> 'HTMLText',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'CheckList'		=> 'CheckList'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'CheckList',
			'CheckListID'
		));

		$fields->replaceField('Icon', DropdownField::create('Icon')->setSource(array(
			'icon-tick'		=> 'Tick',
			'icon-dot'		=> 'Dot'
		)));

		return $fields;
	}

} 