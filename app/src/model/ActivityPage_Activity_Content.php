<?php

namespace OP\Studentsuccess;

use Page;

use OP\Studentsuccess\ActivityPage_Activity;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridField;
use PageController;
use SilverStripe\ORM\DB;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\ORM\DataObject;


class ActivityPage_Activity_Content extends DataObject
{
    private static $table_name = 'ActivityPage_Activity_Content';
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText'
    ];

    private static $has_one = [
        'ActivityStep' => ActivityPage_Activity::class
    ];
}
