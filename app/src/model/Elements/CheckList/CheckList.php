<?php

namespace OP\studentsuccess;


use OP\studentsuccess\CheckListItem;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use OP\studentsuccess\CheckListCollection;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use DNADesign\Elemental\Models\BaseElement;
use OP\studentsuccess\FormUtils;


class CheckList extends BaseElement
{
    private static $table_name = 'CheckList';
    private static $title = "Interactive Checklist";

    private static $description = "Interactive Checklist";

    private static $db = [
        'Summary' => 'Text'
    ];

    private static $has_many = [
        'Items' => CheckListItem::class
    ];

    protected $enable_title_in_template = true;

    private static $field_labels = [
        'Summary' => 'Intro'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'Items',
            'Settings'
        ]);

        $fields->addFieldsToTab('Root.Items', [
            $gridField = FormUtils::MakeDragAndDropGridField('Items', 'Items', $this->Items(), 'SortOrder')
        ]);

        $configs = $gridField->getConfig();
        $adder = new GridFieldAddNewMultiClass();

        $classes = [
            'CheckListCollection' => 'List of items',
            'CheckListItem' => 'Content Item'
        ];

        if ($this instanceof SingleLevelList || $this instanceof SingleLevelCheckList) {
            unset($classes[CheckListCollection::class]);
        }

        $adder->setClasses($classes);

        $configs->removeComponentsByType(GridFieldAddNewButton::class);
        $configs->addComponent($adder);


        return $fields;
    }

    public function getFullWidth()
    {
        return ($this instanceof SingleLevelCheckList || $this instanceof SingleLevelList);
    }
} 