<?php

namespace OP\studentsuccess;


use SilverStripe\ORM\DataObject;


/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 8:53 AM
 * To change this template use File | Settings | File Templates.
 */
class RelatedPage extends DataObject
{
    private static $table_name = 'RelatedPage';
    private static $db = [
        'Title' => 'Varchar',
        'SortOrder' => 'Int'
    ];

    private static $has_one = [
        'Page' => 'Page'
    ];


    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder',
            'Page',
            'PageID'
        ]);

        return $fields;
    }

} 