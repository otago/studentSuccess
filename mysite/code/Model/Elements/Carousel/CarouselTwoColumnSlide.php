<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 4:01 PM
 * To change this template use File | Settings | File Templates.
 */

class CarouselTwoColumnSlide extends CarouselTextSlide {

	private static $db = array(
		'TitlePrefix'			=> 'Varchar',
		'RightColTitle'			=> 'Varchar',
		'RightColContent'		=> 'Text'
	);


	function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('TitlePrefix');

		$fields->addFieldToTab('Root.Main', TextField::create('TitlePrefix')->setTitle('Prefix'), 'Title');

		return $fields;
	}

} 