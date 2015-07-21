<?php

class CarouselTextSlide extends CarouselSlide {

	private static $db = array(
		'Content'		=> 'HTMLText'
	);

	public function getTitle() {
		if(!$this->getField('Title')) {
			return $this->Content;
		}

		return $this->getField('Title');
	}
} 

class CarouselTextSlide_NoTitle extends CarouselTextSlide {

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName('Title');
		
		return $fields;
	}

	public function getTitle() {
		return $this->Content;
	}
} 