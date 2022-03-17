<?php

namespace OP\studentsuccess;


use OP\studentsuccess\Accordion;
use DNADesign\ElementalList\Model\ElementList;


class AccordionItem extends ElementList
{
    private static $table_name = 'AccordionItem';
    private static $db = [
        'AscentColour' => 'Enum("Yellow, Blue, Black, Red")'
    ];

    private static $has_one = [
        'Accordion' => Accordion::class
    ];

    private static $title = 'Accordion Item';

} 