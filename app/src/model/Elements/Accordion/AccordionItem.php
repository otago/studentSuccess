<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\Accordion;
use DNADesign\ElementalList\Model\ElementList;


class AccordionItem extends ElementList
{

    private static $table_name = 'AccordionItem';

    private static $db = [
        'AscentColour' => 'Enum("Yellow, Blue, Black, Red")',
        'ListDescription' => 'HTMLText'
    ];

    private static $has_one = [
        'Accordion' => Accordion::class
    ];

    private static $owns = [
        'Accordion',
        'Elements'
    ];

    private static $title = 'Accordion Item';


    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Accordion');
        return $fields;
    }

    public function canView($member = null)
    {
        return true;
    }
} 