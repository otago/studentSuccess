<?php

namespace OP\studentsuccess;


use FormUtils;
use OP\studentsuccess\CheckListTab;
use DNADesign\Elemental\Models\BaseElement;



class TabbedCheckList extends BaseElement {

	private static $title = "Tabbed Check List Element";

	private static $description = "Tabbed Check List Element";

	private static $has_many = array(
		'Tabs'			=> CheckListTab::class
	);


	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('Tabs');
		$fields->addFieldToTab('Root.Main',
			FormUtils::MakeDragAndDropGridField('Tabs', 'Tabs', $this->Tabs(), 'SortOrder'));

		return $fields;
	}



} 