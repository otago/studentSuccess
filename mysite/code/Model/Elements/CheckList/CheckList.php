<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 2:20 PM
 * To change this template use File | Settings | File Templates.
 */

class CheckList extends BaseElement {

	private static $title = "Check List";
	private static $description = "Check Lists Study";

	private static $db = array(
		'DisplayTitle'		=> 'Varchar',
		'Icon'				=> 'Varchar',
		'Summary'			=> 'Text'
	);

	private static $has_many = array(
		'Items'				=> 'CheckListItem'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'Items',
			'Settings'
		));

		$fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));

		$fields->addFieldsToTab('Root.Items', array(
			$gridField = FormUtils::MakeDragAndDropGridField('Items', 'Items', $this->Items(), 'SortOrder')
		));

		$configs = $gridField->getConfig();
		$adder = new GridFieldAddNewMultiClass();
		$adder->setClasses(array(
			'CheckListCollection'			=> 'List of items',
			'CheckListItem'					=> 'Content Item'
		));
		$configs->removeComponentsByType('GridFieldAddNewButton');
		$configs->addComponent($adder);


		return $fields;


	}

} 