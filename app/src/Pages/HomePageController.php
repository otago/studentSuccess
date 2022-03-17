<?php

namespace OP\studentsuccess;

use Page;


use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\CMS\Model\SiteTree;
use PageController;



class HomePageController extends PageController
{

    private static $allowed_actions = [
        'unsupported'
    ];


}