<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\MasonryTileLink;
use OP\Studentsuccess\FormUtils;


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