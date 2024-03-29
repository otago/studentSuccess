<?php

namespace OP\Studentsuccess;

use OP\Studentsuccess\MasonryTileLink;


class FilterableSmallMasonryTile extends SmallMasonryTile
{

    private static $db = [];
    private static $table_name = 'FilterableSmallMasonryTile';
    private static $belongs_many_many = [
        'LinkLists' => MasonryTileLink::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Content');

        return $fields;
    }
} 