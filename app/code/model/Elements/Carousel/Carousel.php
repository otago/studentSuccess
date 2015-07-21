<?php

class Carousel extends BaseElement {

	private static $title = "Carousel";
	
	private static $description = "Carousel";

	private static $db = array(
		'Background'	=> 'Varchar'
	);

	private static $has_many = array(
		'Slides'		=> 'CarouselSlide'
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
			$configs->removeComponentsByType('GridFieldAddNewButton');
			$configs->addComponent($adder);
		}

		return $fields;
	}

} 