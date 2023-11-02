<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\MasonryContent;
use SilverStripe\ORM\DataObject;


class MasonryTile extends DataObject
{
    private static $table_name = 'MasonryTile';
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'Text',
        'SortOrder' => 'Int',
    ];

    private static $has_one = [
        'MasonryContent' => MasonryContent::class
    ];

    private static $summary_fields = [
        'Title',
        'Thumbnail',
        'singular_name',
        'SortOrder'
    ];

    private static $field_labels = [
        'Title' => 'Heading'
    ];

    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder',
            MasonryContent::class,
            'MasonryContentID'
        ]);

        return $fields;
    }

    public function Render()
    {
        return $this->renderWith($this->ClassName);
    }
    public function Thumbnail(){

        return;
    }

}
