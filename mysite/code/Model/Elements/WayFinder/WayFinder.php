<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 11:13 AM
 * To change this template use File | Settings | File Templates.
 */

class WayFinder extends BaseElement {

	private static $title = "Way Finder";

	private static $description = "Way finder element section";

	protected $enable_title_in_template = true;

	private static $db = array(
	);

	private static $many_many = array(
		'Filters'			=> 'WayFinderFilter',
		'Items'				=> 'WayFinderItem'
	);

	private static $many_many_extraFields = array(
		'Filters'			=> array(
			'SortOrder'		=> 'Int'
		),
		'Items'			=> array(
			'SortOrder'		=> 'Int',
			// 'Filters'		=> 'Varchar(50)',
			'Size'			=> 'Varchar',
			'Background'	=> 'Varchar'
		)
	);


	public function OrderedFilters(){
		return $this->Filters()->sort('SortOrder');
	}


	public function OrderedItems(){
		return $this->Items()->sort('SortOrder');
	}

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'Settings',
			'Filters',
			'Items'
		));

		if($this->ID){
			$fields->addFieldsToTab('Root.Filters', array(
				FormUtils::MakeDragAndDropGridField('Filters', 'Filters', $this->OrderedFilters(), 'SortOrder')
			));




			$fields->addFieldsToTab('Root.Items', array(
				$items = FormUtils::MakeDragAndDropGridField('Items', 'Items', $this->OrderedItems(), 'SortOrder', 'RelationEditor', 20)
			));


			$configs = $items->getConfig();
			$adder = new GridFieldAddNewMultiClass();
			$adder->setClasses(array(
				'WayFinderItem'			=> 'Text time',
				'WayFinderImageItem'	=> 'Image Item'
			));
			$configs->removeComponentsByType('GridFieldAddNewButton');
			$configs->addComponent($adder);

		}

		return $fields;
	}


} 