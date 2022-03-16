<?php

namespace OP\studentsuccess;

use Page;


use OP\studentsuccess\GlossaryType;
use PageController;
use OP\studentsuccess\FormUtils;




class GlossaryPage extends Page {

	private static $db = array();

	private static $has_many = array(
		'GlossaryTypes'		=> GlossaryType::class
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'ElementArea'
		));

		$fields->addFieldToTab('Root.Glossary',
			FormUtils::MakeDragAndDropGridField('GlossaryTypes', 'GlossaryTypes', $this->GlossaryTypes(), 'SortOrder', 'RecordEditor')
		);

		return $fields;
	}
}

class GlossaryPage_Controller extends PageController {


}