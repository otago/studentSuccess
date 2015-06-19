<?php

class CheckList extends BaseElement {

	private static $title = "Interactive Checklist";

	private static $description = "Interactive Checklist";

	private static $db = array(
		'Summary'			=> 'Text'
	);

	private static $has_many = array(
		'Items'				=> 'CheckListItem'
	);

	protected $enable_title_in_template = true;

	private static $field_labels = array(
		'Summary' => 'Intro'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'Items',
			'Settings'
		));

		$fields->addFieldsToTab('Root.Items', array(
			$gridField = FormUtils::MakeDragAndDropGridField('Items', 'Items', $this->Items(), 'SortOrder')
		));

		$configs = $gridField->getConfig();
		$adder = new GridFieldAddNewMultiClass();

		$classes = array(
			'CheckListCollection'			=> 'List of items',
			'CheckListItem'					=> 'Content Item'
		);

		if($this instanceof SingleLevelList || $this instanceof SingleLevelCheckList) {
			unset($classes['CheckListCollection']);
		}
		
		$adder->setClasses($classes);

		$configs->removeComponentsByType('GridFieldAddNewButton');
		$configs->addComponent($adder);


		return $fields;
	}

	public function getFullWidth() {
		return ($this instanceof SingleLevelCheckList || $this instanceof SingleLevelList);
	}
} 