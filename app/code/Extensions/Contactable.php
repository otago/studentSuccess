<?php

class Contactable extends DataExtension {

	private static $db = array(
		'ContactBoxTitle'				=> 'Varchar(70)',
		'ContactBoxContent'				=> 'Varchar(100)',
		'ContactBoxPhone'				=> 'Varchar',
		'ContactBoxEmail'				=> 'Varchar'
	);


	public function updateCMSFields(FieldList $fields){

		$fields->addFieldsToTab('Root.Contacts', array(
			HeaderField::create('ContactBox')->setTitle('Contact element details, if you dont wish to override these from the global settings, leave blank')->setHeadingLevel(4),
			TextField::create('ContactBoxTitle')->setTitle('Title'),
			TextareaField::create('ContactBoxContent')->setTitle('Content'),
			TextField::create('ContactBoxPhone')->setTitle('Phone'),
			TextField::create('ContactBoxEmail')->setTitle('Email'),
		));

	}

	public function HasContactableDetails(){
		return !empty($this->owner->ContactBoxTitle)
			|| !empty($this->owner->ContactBoxContent)
			|| !empty($this->owner->ContactBoxPhone)
			|| !empty($this->owner->ContactBoxEmail);
	}

}