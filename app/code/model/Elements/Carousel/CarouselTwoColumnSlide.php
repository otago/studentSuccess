<?php

class CarouselTwoColumnSlide extends CarouselTextSlide {

	private static $db = array(
		'TitlePrefix'			=> 'Varchar',
		'RightColTitle'			=> 'Varchar',
		'RightColContent'		=> 'HTMLText'
	);


	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->insertAfter(
			TextField::create('TitlePrefix')->setTitle('Prefix')->setDescription('Displays above the title'), 'Title'
		);
		/*
		// if this is the second two column side in the list then remove the left content and title prefix as that's 
		// fixed across all the data points
		if($this->CarouselID) {
			$prev = CarouselTwoColumnSlide::get()->filter(array(
				'CarouselID' => $this->CarouselID,
				'SortOrder:LessThan' => $this->SortOrder
			))->first();

			if($prev) {
				$this->Title = $prev->Title;
				$this->TitlePrefix = $prev->TitlePrefix;
				$this->Content = $prev->Content;

				$fields->makeFieldReadonly('TitlePrefix');
				$fields->makeFieldReadonly('Content');
				$fields->makeFieldReadonly('Title');
			}
		} else {
			$fields->makeFieldReadonly('Content');
			$fields->makeFieldReadonly('Title');
			$fields->makeFieldReadonly('TitlePrefix');
		}
		*/
		return $fields;
	}
} 