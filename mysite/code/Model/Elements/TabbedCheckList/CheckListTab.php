<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 3:20 PM
 * To change this template use File | Settings | File Templates.
 */

class CheckListTab extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'TabbedCheckList'	=> 'TabbedCheckList'
	);

	private static $has_many = array(
		'Blocks'			=> 'CheckListBlock'
	);

	private static $default_sort = 'SortOrder';

	public  function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'TabbedCheckList',
			'TabbedCheckListID',
			'Blocks'
		));

		$fields->addFieldToTab('Root.Main', FormUtils::MakeDragAndDropGridField('Blocks', 'Blocks', $this->Blocks(), 'SortOrder', 'RecordEditor'));

		return $fields;
	}

} 