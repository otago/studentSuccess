<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 10:37 AM
 * To change this template use File | Settings | File Templates.
 */

class FooterLink extends DataObject {

	private static $db = array(
		'Title'				=> 'Varchar',
		'SortOrder'			=> 'Int'
	);

	private static $has_one = array(
		'FooterLinkBlock'	=> 'FooterLinkBlock'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'FooterLinkBlock',
			'FooterLinkBlockID',
			'SortOrder'
		));

		return $fields;
	}

} 