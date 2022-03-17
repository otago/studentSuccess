<?php

namespace OP\studentsuccess;


use OP\studentsuccess\ListCollectionItem;
use OP\studentsuccess\FormUtils;


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

        $fields->addFieldsToTab('Root.Main', [
            FormUtils::MakeDragAndDropGridField('ListCollectionItems', 'Items', $this->ListCollectionItems(), 'SortOrder')
        ]);

        return $fields;
    }

} 