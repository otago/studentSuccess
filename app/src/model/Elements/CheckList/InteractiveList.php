<?php

namespace OP\Studentsuccess;




use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class InteractiveList extends CheckList {

	private static $title = "Interactive List";

	private static $description = "Interactive List";

    public function getType()
    {
        return 'Interactive List';
    }
    private static $inline_editable = false;



}