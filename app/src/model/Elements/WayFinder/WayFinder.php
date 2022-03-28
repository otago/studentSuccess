<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\WayFinderFilter;
use OP\Studentsuccess\WayFinderItem;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridField_ActionMenu;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\FormUtils;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


class WayFinder extends BaseElement
{
    private static $table_name = 'WayFinder';
    private static $title = "Way Finder";

    private static $singular_name = 'WayFinder';
    private static $plural_name = 'WayFinder';

    private static $description = "Way finder element section";

    protected $enable_title_in_template = true;

    private static $db = [
    ];

    private static $many_many = [
        'Filters' => WayFinderFilter::class,
        'Items' => WayFinderItem::class
    ];

    private static $many_many_extraFields = [
        'Filters' => [
            'SortOrder' => 'Int'
        ],
        'Items' => [
            'SortOrder' => 'Int',
            // 'Filters'		=> 'Varchar(50)',
            'Size' => 'Varchar',
            'Background' => 'Varchar'
        ]
    ];
    private static $inline_editable = false;

    public function getType()
    {
        return 'WayFinder';
    }

    public function OrderedFilters()
    {
        return $this->Filters()->sort('SortOrder');
    }


    public function OrderedItems()
    {
        return $this->Items()->sort('SortOrder');
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'Settings',
            'Filters',
            'Items'
        ]);
        $heroconf = GridFieldConfig_RelationEditor::create();
        $heroconf->addComponent(new GridFieldOrderableRows('SortOrder'), new GridFieldButtonRow());

        $heroconf2 = GridFieldConfig_RelationEditor::create();
        $heroconf2->addComponent(new GridFieldOrderableRows('SortOrder'), new GridFieldButtonRow());

        if ($this->ID) {

            $fields->addFieldsToTab('Root.Main', [
                GridField::create('Filters', 'Filters', $this->Filters(), $heroconf)
            ]);

            $fields->addFieldsToTab('Root.Main', [
                $items = GridField::create('Items', 'Items', $this->Items(), $heroconf)

            ]);

            $configs = $items->getConfig();
            $adder = new GridFieldAddNewMultiClass();
            $adder->setClasses([
                WayFinderItem::class => 'Text Link',
                WayFinderImageItem::class => 'Image Link'
            ]);
            $configs->removeComponentsByType(GridFieldAddNewButton::class);
            $configs->addComponent($adder);
        }
        return $fields;
    }


} 