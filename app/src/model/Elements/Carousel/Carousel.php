<?php

namespace OP\studentsuccess;





use OP\studentsuccess\Carousel;
use OP\studentsuccess\CarouselSlide;
use SilverStripe\Forms\DropdownField;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use DNADesign\Elemental\Models\BaseElement;
use OP\studentsuccess\FormUtils;




class Carousel extends BaseElement {

	private static $title = Carousel::class;
	
	private static $description = Carousel::class;

	private static $db = array(
		'Background'	=> 'Varchar'
	);

	private static $has_many = array(
		'Slides'		=> CarouselSlide::class
	);

	function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('Slides');

		$fields->replaceField('Background', DropdownField::create('Background')->setSource(array(
			'blue'		=> 'Blue (Default)',
			'red'		=> 'Red',
			'green'		=> 'Green',
			'gray'		=> 'Gray'
		)));

		if($this->ID) {
			$fields->addFieldsToTab('Root.Main', array(
				$grid = FormUtils::MakeDragAndDropGridField('Slides', 'Slides', $this->Slides(), 'SortOrder')
			));

			$configs = $grid->getConfig();
			$adder = new GridFieldAddNewMultiClass();
			$adder->setClasses(array(
				'CarouselSlide'					=> 'Slide with only a title',
				'CarouselTextSlide'				=> 'Slide with title and content',
				'CarouselTextSlide_NoTitle'		=> 'Slide with just content',
				'CarouselTwoColumnSlide'		=> 'Slide with two columns of content'
			));
			$configs->removeComponentsByType(GridFieldAddNewButton::class);
			$configs->addComponent($adder);
		}

		return $fields;
	}

} 