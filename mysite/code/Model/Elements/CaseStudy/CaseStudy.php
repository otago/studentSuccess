<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 1:44 PM
 * To change this template use File | Settings | File Templates.
 */

class CaseStudy extends BaseElement {

	private static $title = "Case Study";

	private static $description = "Case Study";

	private static $db = array(
		'DisplayTitle'		=> 'Varchar',
		'Summary'			=> 'Text',
		'CaseStudyContent'	=> 'HTMLText',
		'Color'				=> 'Varchar'
	);

	private static $has_one = array(
		'Image'				=> 'Image'
	);

	function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('Color');
		$fields->addFieldToTab('Root.Main', DropdownField::create('Color')->setSource(array(
			'green'		=> 'Green',
			'red'		=> 'Red',
			'blue'		=> 'Blue'
		)));

		return $fields;
	}

} 