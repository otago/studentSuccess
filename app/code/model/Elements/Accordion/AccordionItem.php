<?php

class AccordionItem extends ElementList {

	private static $db = array(
		'AscentColour' => 'Enum("Yellow, Blue, Black, Red")'
	);

	private static $has_one = array(
		'Accordion'		=> 'Accordion'
	);

	private static $title = 'Accordion Item';

} 