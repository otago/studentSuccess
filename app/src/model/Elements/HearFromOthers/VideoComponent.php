<?php

namespace OP\Studentsuccess;


use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\FieldType\DBField;


class VideoComponent extends HearFromOthers
{
    private static $table_name = 'VideoComponent';
    private static $singular_name = "Video";

    private static string $icon = 'font-icon-block-video';
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
            'tpmediumgreen' => 'Medium Green',
            'tplightgreen' => 'Light Green',
            'tpmaroon' => 'Maroon',
            'tpstone' => 'Stone'
        ]));

        return $fields;
    }

    public function getSummary()
    {
        return DBField::create_field('HTMLText', '['.self::$singular_name.']')->Summary(20);
    }
}
