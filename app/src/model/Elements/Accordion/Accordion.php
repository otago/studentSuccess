<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\AccordionItem;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Versioned\Versioned;
use OP\Studentsuccess\FormUtils;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


class Accordion extends BaseElement
{
    private static $table_name = 'Accordion';
    private static $singular_name = 'Accordion';

    private static $description = 'Accordion';

    private static $icon = 'font-icon-block-accordion';
    private static $inline_editable = false;

    private static $has_many = [
        'Items' => AccordionItem::class
    ];

    private static $owns = [
        'Items'
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Items');
        $heroconf = GridFieldConfig_RelationEditor::create();
        $heroconf->addComponent(new GridFieldOrderableRows('Sort'), new GridFieldButtonRow());

        if ($this->ID) {
            $fields->addFieldToTab('Root.Main',
                 GridField::create('Items', 'Items', $this->Items(), $heroconf)
            );
        }

        return $fields;
    }

    public function Elements()
    {
        return $this->Items();
    }

    public function shouldCleanupElement($widget)
    {
        if ($widget->AccordionID == 0) {
            return true;
        }

        return false;
    }

//    public function onAfterWrite()
//    {
//        parent::onAfterWrite();
//        foreach ($this->Items() as $Item) {
//            if (!$Item->isPublished()) {
////                $Item->publishSingle();
//                $Item->publishRecursive();
//            }
//        }
//    }
}

