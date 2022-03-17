<?php

namespace OP\studentsuccess;

use Page;


use OP\studentsuccess\GlossaryType;
use PageController;
use OP\studentsuccess\FormUtils;


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

        $fields->addFieldToTab('Root.Glossary',
            FormUtils::MakeDragAndDropGridField('GlossaryTypes', 'GlossaryTypes', $this->GlossaryTypes(), 'SortOrder', 'RecordEditor')
        );

        return $fields;
    }
}

class GlossaryPage_Controller extends PageController
{


}