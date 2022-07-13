<?php

namespace OP\Studentsuccess;

use Page;


use OP\Studentsuccess\GlossaryType;
use PageController;
use OP\Studentsuccess\FormUtils;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


class GlossaryPage extends Page
{

    private static $table_name = 'GlossaryPage';
    private static $db = [];

    private static $has_many = [
        'GlossaryTypes' => GlossaryType::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'ElementArea'
        ]);

        $fields->addFieldsToTab('Root.Glossary', [
            GridField::create('GlossaryTypes', 'GlossaryTypes', $this->GlossaryTypes(), GridFieldConfig_RelationEditor::create()->addComponent(new GridFieldOrderableRows('SortOrder'))),
        ]);

        return $fields;
    }
}
