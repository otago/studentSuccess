<?php

namespace OP\studentsuccess;


use OP\studentsuccess\Carousel;
use SilverStripe\ORM\DataObject;



class CarouselSlide extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'Carousel'			=> Carousel::class
	);
	
	private static $default_sort = 'SortOrder';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			Carousel::class,
			'CarouselID'
		));

		return $fields;
	}

	function Render() {
		return $this->renderWith($this->ClassName);
	}

} 