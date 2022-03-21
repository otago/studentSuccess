<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\GlossaryType;
use SilverStripe\ORM\DataObject;


class GlossaryItem extends DataObject
{
    private static $table_name = 'GlossaryItem';
    private static $db = [
        'Title' => 'Varchar(255)',
        'ShowContactInfo' => 'Boolean',
        'Content' => 'HTMLText',
        'SortOrder' => 'Int'
    ];

    private static $has_one = [
        'GlossaryType' => GlossaryType::class
    ];

    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder',
            GlossaryType::class,
            'GlossaryTypeID'
        ]);

        return $fields;
    }

} 