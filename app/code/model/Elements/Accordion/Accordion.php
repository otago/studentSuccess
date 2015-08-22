<?php

class Accordion extends BaseElement {

	private static $title = "Accordion";

	private static $description = "Accordion";

	private static $has_many = array(
		'Items'			=> 'AccordionItem'
	);

	private static $extensions = array(
		'ElementPublishChildren'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Item');

		if($this->ID){
			$fields->addFieldToTab('Root.Main',
				FormUtils::MakeDragAndDropGridField('Items', 'Items', $this->Items(), 'Sort')
			);
		}

		return $fields;
	}

	public function Elements() {
		return $this->Items();
	}

	public function shouldCleanupElement($widget) {
		if($widget->AccordionID == 0) {
			return true;
		}

		return false;
	}
} 