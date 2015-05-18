<?php

class CarouselWithUpperLetter extends Carousel{
	
	private static $title = "Carousel Element with upper letter";
	private static $description = "Carousel Element with upper letter";
	
	function getCMSFields() {
		$fields = parent::getCMSFields();
		if($this->ID){
			if($slidesGrid = $fields->dataFieldByName('Slides')){
				$configs = $slidesGrid->getConfig();
				$adder = new GridFieldAddNewMultiClass();
				$configs->removeComponentsByType('GridFieldAddNewMultiClass');
				$adder->setClasses(array(
					'CarouselSlideWithUpperLetter'	=>  'Slides with upper letter title and content'
				));
				$configs->addComponent($adder);
			}
		}
		
		return $fields;
	}
}
