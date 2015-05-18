<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 6:35 PM
 * To change this template use File | Settings | File Templates.
 */

class Accordion extends BaseElement {

	private static $title = "Accordion Element";
	private static $description = "Accordion Element";

	private static $has_many = array(
		'Items'			=> 'AccordionItem'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('Item');

		if($this->ID){
			$fields->addFieldToTab('Root.Main',
				FormUtils::MakeDragAndDropGridField('Items', 'Items', $this->Items(), 'SortOrder')
			);
		}

		return $fields;
	}


} 