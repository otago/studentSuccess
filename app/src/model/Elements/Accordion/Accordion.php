<?php

namespace OP\studentsuccess;





use OP\studentsuccess\Accordion;
use OP\studentsuccess\AccordionItem;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Versioned\Versioned;
use OP\studentsuccess\FormUtils;




class Accordion extends BaseElement {

	private static $title = Accordion::class;

	private static $description = Accordion::class;

	private static $has_many = array(
		'Items'			=> AccordionItem::class
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

/*
class Accordion_ElementPublishChildren extends ElementPublishChildren {

	public function onBeforeVersionedPublish() {
		$staged = array();

		foreach($this->owner->Elements() as $widget) {
			$staged[] = $widget->ID;

			$widget->publish('Stage', 'Live');
		}

		// remove any elements that are on live but not in draft or have been
		// unlinked from everything
		$widgets = Versioned::get_by_stage(AccordionItem::class, 'Live', "AccordionID = '". $this->owner->ID ."'");

		foreach($widgets as $widget) {
			if(!in_array($widget->ID, $staged)) {
				$widget->deleteFromStage('Live');
			}
		}
	}
}*/