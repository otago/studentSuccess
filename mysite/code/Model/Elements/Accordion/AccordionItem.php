<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 6:35 PM
 * To change this template use File | Settings | File Templates.
 */

class AccordionItem extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'Content'		=> 'HTMLText',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'Accordion'		=> 'Accordion'
	);

	private static $default_sort = 'SortOrder';

	function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'Accordion',
			'AccordionID'
		));

		return $fields;
	}

} 