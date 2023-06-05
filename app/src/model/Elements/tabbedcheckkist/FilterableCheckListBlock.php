<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\FilterableCheckList;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\CheckboxField;


class FilterableCheckListBlock extends CheckListBlock
{
    private static $table_name = 'FilterableCheckListBlock';
    private static $db = [
        'AppliesToIam' => 'Varchar(255)',
        'AppliesToMoving' => 'Varchar(255)',
        'AppliesToStudy' => 'Varchar(255)',
        'AppliesToLocations' => 'Varchar(255)',
        'AppliesToFirstTrimester' => 'Boolean',
        'AppliesToSecondTrimester' => 'Boolean'
    ];

    private static $has_one = [
        'FilterableCheckList' => FilterableCheckList::class
    ];

    private static $summary_fields = [
        'Title',
        'AppliesToIam',
        'AppliesToMoving',
        'AppliesToLocations',
        'AppliesToFirstTrimester'
    ];


    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'AppliesToIam',
            'AppliesToMoving',
            'AppliesToStudy',
            'AppliesToLocations',
            'AppliesToFirstTrimester',
            'AppliesToSecondTrimester'
        ]);

        $fields->addFieldsToTab('Root.Main', [
            new CheckboxSetField('AppliesToIam', 'Applies to the following selections', FilterableCheckList::$iam),
            new CheckboxSetField('AppliesToMoving', '', FilterableCheckList::$moving),
            new CheckboxSetField('AppliesToLocations', '', FilterableCheckList::$locations),
            new CheckboxField('AppliesToFirstTrimester'),
            new CheckboxField('AppliesToSecondTrimester'),
        ]);

        return $fields;
    }
}
