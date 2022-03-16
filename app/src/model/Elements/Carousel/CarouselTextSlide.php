<?php

namespace OP\studentsuccess;




class CarouselTextSlide extends CarouselSlide {

	private static $db = array(
		'Content'		=> 'HTMLText'
	);
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