<?php

class CarouselTwoColumnSlide extends CarouselTextSlide {

	private static $db = array(
		'TitlePrefix'			=> 'Varchar',
		'RightColTitle'			=> 'Varchar',
		'RightColContent'		=> 'HTMLText'
	);


	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('TitlePrefix');

		$fields->addFieldToTab('Root.Main', TextField::create('TitlePrefix')->setTitle('Prefix'), 'Title');

		return $fields;
	}
} 