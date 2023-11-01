<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\CheckListTab;
use OP\Studentsuccess\CheckListBlockItem;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\ORM\DataObject;
use OP\Studentsuccess\FormUtils;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


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

        $fields->addFieldsToTab('Root.Main', [
            GridField::create('Items', 'Items', $this->Items(), GridFieldConfig_RelationEditor::create()->addComponent(new GridFieldOrderableRows('SortOrder'))),
        ]);
        $fields->replaceField('Color', DropdownField::create('Color')->setSource([
            'tpmediumgreen' => 'Medium Green',
            'tpmaroon' => 'Maroon',
            'tpdark-green' => 'Dark Green',
            'tpstone' => 'Stone'
        ]));

        return $fields;
    }

}
