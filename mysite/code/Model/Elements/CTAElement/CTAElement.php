<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 5:16 PM
 * To change this template use File | Settings | File Templates.
 */

class CTAElement extends BaseElement {

	private static $title = "CTA Element";
	private static $description = "CTA elements";

	private static $db = array(
		'DisplayTitle'		=> 'Varchar',
		'Color'				=> 'Varchar',
		'Icon'				=> 'Varchar',
		'ButtonText'		=> 'Varchar',
		'CTAContent'		=> 'Text',
	);

	private static $has_one = array(
		'Image'				=> 'Image'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->replaceField('Color', DropdownField::create('Color')->setSource(array(
			'orange'		=> 'Orange (Default)',
			'black'			=> 'Black'
		)));
		$fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));

		$fields->dataFieldByName('CTAContent')->setTitle('Content');

		return $fields;
	}
} 