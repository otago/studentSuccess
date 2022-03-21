<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\CheckListTab;
use OP\Studentsuccess\CheckListBlockItem;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\DataObject;
use OP\Studentsuccess\FormUtils;


/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 3:22 PM
 * To change this template use File | Settings | File Templates.
 */
class CheckListBlock extends DataObject
{
    private static $table_name = 'CheckListBlock';
    private static $db = [
        'Title' => 'Varchar',
        'Color' => 'Varchar',
        'SortOrder' => 'Int'
    ];

    private static $has_one = [
        'CheckListTab' => CheckListTab::class
    ];

    private static $has_many = [
        'Items' => CheckListBlockItem::class
    ];

    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder',
            CheckListTab::class,
            'CheckListTabID'
        ]);

        $fields->addFieldToTab('Root.Main', FormUtils::MakeDragAndDropGridField('Items', 'Items', $this->Items(), 'SortOrder', 'RecordEditor'));
        $fields->replaceField('Color', DropdownField::create('Color')->setSource([
            'red' => 'Red (Default)',
            'blue' => 'Blue',
            'green' => 'Green',
            'yellow' => 'Yellow'
        ]));

        return $fields;
    }

} 