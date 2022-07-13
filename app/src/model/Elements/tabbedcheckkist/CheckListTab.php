<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\TabbedCheckList;
use OP\Studentsuccess\CheckListBlock;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\ORM\DataObject;
use OP\Studentsuccess\FormUtils;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


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

        $fields->addFieldsToTab('Root.Main', [
            GridField::create('Blocks', 'Blocks', $this->Blocks(), GridFieldConfig_RelationEditor::create()->addComponent(new GridFieldOrderableRows('SortOrder'))),
        ]);
        return $fields;
    }

} 