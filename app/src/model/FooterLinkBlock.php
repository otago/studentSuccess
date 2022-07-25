<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\FooterLink;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\ORM\DataObject;
use OP\Studentsuccess\FormUtils;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


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
            GridField::create('Links', 'Links', $this->Links(), GridFieldConfig_RelationEditor::create()->addComponent(new GridFieldOrderableRows('SortOrder'))),
        ]);

        return $fields;
    }

} 