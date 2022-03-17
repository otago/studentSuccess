<?php

namespace OP\studentsuccess;


use OP\studentsuccess\MasonryTileLink;
use OP\studentsuccess\FormUtils;


class LinkListMasonryTile extends MasonryTile
{
    private static $table_name = 'LinkListMasonryTile';
    private static $has_many = [
        'Links' => MasonryTileLink::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'Content'
        ]);

        $fields->addFieldToTab('Root.Main',
            FormUtils::MakeDragAndDropGridField('Links', 'Links', $this->Links(), 'SortOrder', 'RecordEditor')
        );

        return $fields;

    }
} 