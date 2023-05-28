<?php

namespace OP\Studentsuccess;


use SilverStripe\Forms\DropdownField;


class VideoComponent extends HearFromOthers
{
    private static $table_name = 'VideoComponent';
    private static $singular_name = "Video";

    private static $description = "Video Component with modal player";

    private static $db = [
        'Color' => 'Varchar',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', DropdownField::create('Color')->setSource([
            'green' => 'Green',
            'red' => 'Red',
            'blue' => 'Blue',
            'yellow' => 'Yellow'
        ]));

        return $fields;
    }
}
