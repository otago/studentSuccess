<?php

class CheckList extends BaseElement {

	private static $title = "Interactive checklist";

	private static $description = "Interactive checklist";

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
		$adder->setClasses(array(
			'CheckListCollection'			=> 'List of items',
			'CheckListItem'					=> 'Content Item'
		));
		$configs->removeComponentsByType('GridFieldAddNewButton');
		$configs->addComponent($adder);


		return $fields;


	}

} 