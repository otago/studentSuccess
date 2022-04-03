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
        'Accordion'
    ];

    private static $title = 'Accordion Item';

//    public function Elements()
//    {
//        return $this->Accordion();
//    }
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Accordion');
        return $fields;
    }
//    public function CMSEditLink($directLink = false)
//    {
//        //        $admin = MyModelAdmin::singleton();
//        //  $admin = singleton(DataobjectExtension);
//        $admin = AccordionItem::singleton();
//
//        $urlClass = str_replace('\\', '-', self::class);
//        return $admin->Link("/{$urlClass}/EditForm/field/{$urlClass}/item/{$this->ID}/edit");
//    }


} 