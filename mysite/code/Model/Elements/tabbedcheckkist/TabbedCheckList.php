<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 3:19 PM
 * To change this template use File | Settings | File Templates.
 */

class TabbedCheckList extends BaseElement {


	private static $title = "Tabbed Check List Element";
	private static $description = "Tabbed Check List Element";

	private static $has_many = array(
		'Tabs'			=> 'CheckListTab'
	);


	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('Tabs');
		$fields->addFieldToTab('Root.Main',
			FormUtils::MakeDragAndDropGridField('Tabs', 'Tabs', $this->Tabs(), 'SortOrder'));

		return $fields;
	}



} 