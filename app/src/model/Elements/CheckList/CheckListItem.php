<?php

namespace OP\Studentsuccess;


use SingleLevelChecklist;
use OP\Studentsuccess\CheckList;
use SilverStripe\ORM\DataObject;


class CheckListItem extends DataObject
{
    private static $table_name = 'CheckListItem';
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'UseArrow' => 'Boolean',
        'SortOrder' => 'Int'
    ];

    private static $has_one = [
        'CheckList' => CheckList::class
    ];

    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder',
            CheckList::class,
            'CheckListID',
            'UseArrow'
        ]);

        $parent = $this->CheckList();

        if ($parent->exists()) {
            if ($parent instanceof SingleLevelChecklist || $parent instanceof SingleLevelList) {
                $fields->removeByName('Content');
            }
        } else {
            $fields->removeByName('Content');
        }

        $fields->removeByName('UseArrow');

        return $fields;
    }


    public function getUseArrow()
    {
        if ($parent = $this->CheckList()) {
            return ($parent instanceof SingleLevelList || $parent instanceof InteractiveList);
        }

        return false;
    }
} 