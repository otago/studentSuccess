<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\ListCollectionItem;
use OP\Studentsuccess\FormUtils;


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