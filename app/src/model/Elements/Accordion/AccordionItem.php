<?php

namespace OP\studentsuccess;


use OP\studentsuccess\Accordion;
use DNADesign\ElementalList\Model\ElementList;




class AccordionItem extends ElementList {

	private static $db = array(
		'AscentColour' => 'Enum("Yellow, Blue, Black, Red")'
	);

	private static $has_one = array(
		'Accordion'		=> Accordion::class
	);

	private static $title = 'Accordion Item';

} 