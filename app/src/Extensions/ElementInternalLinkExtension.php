<?php

namespace OP\Studentsuccess;


use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\ORM\DataExtension;


class ElementInternalLinkExtension extends DataExtension
{

    private static $db = [
        'OpenInModal' => 'Boolean'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.Main', new CheckboxField('OpenInModal'));
    }
}