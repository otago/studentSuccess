<?php

namespace OP\studentsuccess;


use OP\studentsuccess\FooterLink;
use SilverStripe\ORM\DataObject;
use OP\studentsuccess\FormUtils;


class FooterLinkBlock extends DataObject
{
    private static $table_name = 'FooterLinkBlock';
    private static $db = [
        'Title' => 'Varchar',
        'SortOrder' => 'Int'
    ];

    private static $has_many = [
        'Links' => FooterLink::class
    ];

    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder',
            'Links'
        ]);

        $fields->addFieldsToTab('Root.Links', [
            FormUtils::MakeDragAndDropGridField('Links', 'Links', $this->Links(), 'SortOrder')
        ]);

        return $fields;
    }

} 