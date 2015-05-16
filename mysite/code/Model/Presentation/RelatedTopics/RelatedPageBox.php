<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 8:54 AM
 * To change this template use File | Settings | File Templates.
 */

class RelatedPageBox extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'LinkButton'	=> 'Varchar',
		'Icon'			=> 'Varchar',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'Page'			=> 'Page'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'Page',
			'PageID',
			'Icon'
		));

		// $fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));


		return $fields;
	}

} 