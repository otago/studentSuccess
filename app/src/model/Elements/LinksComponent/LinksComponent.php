<?php

namespace OP\studentsuccess;




use SilverStripe\Assets\Image;
use OP\studentsuccess\LinkElement;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;
use OP\studentsuccess\FormUtils;




class LinksComponent extends BaseElement {

	private static $title = "Group of links";
	
	private static $description = "Shows a list of links";

	private static $db = array(
		'DisplayContent'	=> 'HTMLText',
		'Color'				=> 'Varchar'
	);

	private static $has_one = array(
		'Image'				=> Image::class
	);

	private static $many_many = array(
		'Links'				=> LinkElement::class
	);

	private static $many_many_extraFields = array(
		'Links'				=> array(
			'SortOrder'		=> 'Int'
		)
	);

	protected $enable_title_in_template = true;

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName('Links');

		$fields->replaceField('Color', DropdownField::create('Color')->setSource(array(
			'blue'		=> 'Blue (Default)',
			'red'		=> 'Red',
			'green'		=> 'Green'
		)));

		if($this->ID){
			$fields->addFieldToTab('Root.Main', FormUtils::MakeDragAndDropGridField('Links', 'Links', $this->OrderedLinks(), 'SortOrder', 'RecordEditor'));
		}

		return $fields;
	}

	public function OrderedLinks(){
		return $this->Links()->sort('SortOrder');
	}



} 