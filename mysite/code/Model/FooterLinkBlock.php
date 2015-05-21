<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 10:36 AM
 * To change this template use File | Settings | File Templates.
 */

class FooterLinkBlock extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'SortOrder'		=> 'Int'
	);

	private static $has_many = array(
		'Links'			=> 'FooterLink'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'Links'
		));

		$fields->addFieldsToTab('Root.Links', array(
			FormUtils::MakeDragAndDropGridField('Links', 'Links', $this->Links(), 'SortOrder')
		));

		return $fields;
	}

} 