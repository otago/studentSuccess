<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\TabbedCheckList;
use OP\Studentsuccess\CheckListBlock;
use SilverStripe\ORM\DataObject;
use OP\Studentsuccess\FormUtils;


class CheckListTab extends DataObject
{
    private static $table_name = 'CheckListTab';
    private static $db = [
        'Title' => 'Varchar',
        'SortOrder' => 'Int'
    ];

    private static $has_one = [
        'TabbedCheckList' => TabbedCheckList::class
    ];

    private static $has_many = [
        'Blocks' => CheckListBlock::class
    ];

    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder',
            TabbedCheckList::class,
            'TabbedCheckListID',
            'Blocks'
        ]);

        $fields->addFieldToTab('Root.Main', FormUtils::MakeDragAndDropGridField('Blocks', 'Blocks', $this->Blocks(), 'SortOrder', 'RecordEditor'));

        return $fields;
    }

} 