<?php

namespace OP\studentsuccess;


use SilverStripe\ORM\DataObject;


class LinkElement extends DataObject
{
    private static $table_name = 'LinkElement';
    private static $db = [
        'Title' => 'Varchar'
    ];

} 