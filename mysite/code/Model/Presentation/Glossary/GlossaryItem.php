<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 2:12 PM
 * To change this template use File | Settings | File Templates.
 */

class GlossaryItem extends DataObject {

	private static $db = array(
		'Title'				=> 'Varchar',
		'ShowContactInfo'	=> 'Boolean',
		'Content'			=> 'HTMLText',
		'SortOrder'			=> 'Int'
	);

	private static $has_one = array(
		'GlossaryType'		=> 'GlossaryType'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'GlossaryType',
			'GlossaryTypeID'
		));

		return $fields;
	}

} 