<?php

namespace OP\Studentsuccess;


use SilverStripe\ORM\DataObject;


/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 11:15 AM
 * To change this template use File | Settings | File Templates.
 */
class WayFinderFilter extends DataObject
{
    private static $table_name = 'WayFinderFilter';
    private static $db = [
        'Title' => 'Varchar'
    ];

} 