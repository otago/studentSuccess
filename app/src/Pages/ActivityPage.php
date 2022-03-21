<?php

namespace OP\Studentsuccess;

use Page;


use DisplayLogicWrapper;


use OP\Studentsuccess\ActivityPage_Activity;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridField;
use PageController;
use OP\Studentsuccess\ActivityPage_Activity_Content;
use SilverStripe\ORM\DB;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\ORM\DataObject;


/**
 *
 */
class ActivityPage extends Page
{

    private static $table_name = 'ActivityPage';

    private static $db = [
        'ColorScheme' => 'Varchar(200)',
        'Icon' => 'Enum("pencil, question, none", "none")',
        'MaxAttempts' => 'Int',
        'Validation' => 'Enum("OnEachStep,OnComplete", "OnComplete")'
    ];

    private static $has_many = [
        'Activities' => ActivityPage_Activity::class
    ];

    private static $defaults = [
        'MaxAttempts' => 3
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', new DropdownField('ColorScheme', 'Color Scheme', [
            'black' => 'Black',
            'blue' => 'Blue'
        ]));

        $fields->addFieldToTab('Root.Main', new DropdownField('Icon', 'Icon', [
            'none' => 'None',
            'pencil' => 'Pencil',
            'question' => 'Question'
        ]));

        if (!$this->MaxAttempts) {
            $this->MaxAttempts = 3;
        }

        $fields->addFieldToTab('Root.Main', new NumericField('MaxAttempts', 'Max attempts'));

        $fields->removeByName('Content');

        $fields->addFieldToTab('Root.Main', $validation = new DropdownField(
            'Validation', 'Validation method', $this->dbObject('Validation')->enumValues()
        ));

        $validation->setDescription('How do you want to mark the activity, on each step would require the user to select the correct answer before proceeding and on complete will wait till the end');

        $config = new GridFieldConfig_RelationEditor();
        $config->addComponent(new GridFieldOrderableRows('Sort'));

        $steps = new GridField('Activities', 'Activities', $this->Activities(), $config);

        $fields->addFieldToTab('Root.Main', $steps);


        return $fields;
    }
}