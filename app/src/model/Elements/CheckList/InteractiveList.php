<?php

namespace OP\Studentsuccess;




use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class InteractiveList extends CheckList {

	private static $singular_name = "Interactive List";

	private static $description = "Interactive List";
    private static string $icon = 'font-icon-list';
    private static $inline_editable = false;

    public function getType()
    {
        return self::$singular_name;
    }



}
