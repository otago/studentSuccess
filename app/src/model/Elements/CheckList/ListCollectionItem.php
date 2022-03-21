<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\CheckListCollection;
use SilverStripe\ORM\DataObject;


class ListCollectionItem extends DataObject
{
    private static $table_name = 'ListCollectionItem';

    private static $db = [
        'Content' => 'Text',
        'SortOrder' => 'Int'
    ];

    private static $summary_fields = [
        'Content'
    ];

    private static $has_one = [
        'CheckListCollection' => CheckListCollection::class
    ];

    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'CheckListCollectionID',
            CheckListCollection::class,
            'SortOrder'
        ]);

        return $fields;
    }

} 