<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\ListCollectionItem;
use OP\Studentsuccess\FormUtils;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


class CheckListCollection extends CheckListItem
{

    private static $has_many = [
        'ListCollectionItems' => ListCollectionItem::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Content');
        $fields->removeByName('ListCollectionItems');

        $heroconf = GridFieldConfig_RelationEditor::create();
        $heroconf->addComponent(new GridFieldOrderableRows('SortOrder'), new GridFieldButtonRow());


        $fields->addFieldsToTab('Root.Main', [
            GridField::create('ListCollectionItems', 'Items', $this->ListCollectionItems(), $heroconf)
        ]);

        return $fields;
    }

} 