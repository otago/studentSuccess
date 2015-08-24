<?php


class WayFinderItem extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'Description'	=> 'Text',
		'Icon'			=> 'Varchar'
	);

	private static $summary_fields = array(
		'Icon',
		'Title',
		'Description'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('Icon');
		$fields->addFieldsToTab('Root.Main', DropdownField::create('Icon')->setSource(
			Config::inst()->get('SiteConfig', 'Icons')
		)->setEmptyString('None'));


		$fields->addFieldsToTab('Root.Settings', array(
			//CheckboxSetField::create('ManyMany[Filters]')->setTitle('Filters')
			//	->setSource(WayFinderFilter::get()->map()->toArray()),
			DropdownField::create('ManyMany[Size]')->setSource(array(
				'col-1'		=> 'One Column',
				'col-2'		=> 'Two Columns',
				'col-3'		=> 'Three Columns'
			)),
			DropdownField::create('ManyMany[Background]')->setSource(array(
				'lighter-blue'		=> 'Blue',
				'light-green'		=> 'Green',
				'getting-started'	=> 'Yellow'
			))
		));

		return $fields;
	}

	function Render(){
		return $this->renderWith($this->ClassName);
	}

} 