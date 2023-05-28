<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\CheckListItem;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use OP\Studentsuccess\CheckListCollection;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\FormUtils;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


class CheckList extends BaseElement
{
    private static $table_name = 'CheckList';
    private static $singular_name = "Interactive Checklist";

    private static $description = "Interactive Checklist";

    private static $db = [
        'Intro' => 'Text'
    ];

    private static $has_many = [
        'Items' => CheckListItem::class
    ];

    protected $enable_title_in_template = true;

    private static $field_labels = [
        'Summary' => 'Intro'
    ];
    private static $owns = [
        'Items'
    ];

    private static $inline_editable = false;


    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'Items',
            'Settings'
        ]);
        $Itemsconf = GridFieldConfig_RelationEditor::create();
        $Itemsconf->removeComponentsByType(new GridFieldOrderableRows());
        $Itemsconf->addComponent(new GridFieldOrderableRows('SortOrder'));

        $fields->addFieldsToTab('Root.Main', [
            $gridField = GridField::create('Items', 'Items', $this->Items(), $Itemsconf)
        ]);

        $configs = $gridField->getConfig();
        $adder = new GridFieldAddNewMultiClass();

        $classes = [
            CheckListCollection::class => 'List of items',
            CheckListItem::class => 'Content Item'
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
