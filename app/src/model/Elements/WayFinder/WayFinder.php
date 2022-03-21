<?php

namespace OP\Studentsuccess;




use OP\Studentsuccess\WayFinderFilter;
use OP\Studentsuccess\WayFinderItem;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\FormUtils;




class WayFinder extends BaseElement {

	private static $title = "Way Finder";

	private static $description = "Way finder element section";

	protected $enable_title_in_template = true;

	private static $db = array(
	);

	private static $many_many = array(
		'Filters'			=> WayFinderFilter::class,
		'Items'				=> WayFinderItem::class
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
				'WayFinderItem'			=> 'Text Link',
				'WayFinderImageItem'	=> 'Image Link'
			));
			$configs->removeComponentsByType(GridFieldAddNewButton::class);
			$configs->addComponent($adder);

		}

		return $fields;
	}


} 