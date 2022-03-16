<?php

namespace OP\studentsuccess;


use FormUtils;

use OP\studentsuccess\CheckListTab;
use OP\studentsuccess\CheckListBlockItem;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\DataObject;


/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 3:22 PM
 * To change this template use File | Settings | File Templates.
 */

class CheckListBlock extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'Color'			=> 'Varchar',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'CheckListTab'	=> CheckListTab::class
	);

	private static $has_many = array(
		'Items'			=> CheckListBlockItem::class
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			CheckListTab::class,
			'CheckListTabID'
		));

		$fields->addFieldToTab('Root.Main', FormUtils::MakeDragAndDropGridField('Items', 'Items', $this->Items(), 'SortOrder', 'RecordEditor'));
		$fields->replaceField('Color', DropdownField::create('Color')->setSource(array(
			'red'		=> 'Red (Default)',
			'blue'		=> 'Blue',
			'green'		=> 'Green',
			'yellow'	=> 'Yellow'
		)));

		return $fields;
	}

} 