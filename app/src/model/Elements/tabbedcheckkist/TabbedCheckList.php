<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\CheckListTab;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\FormUtils;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


class TabbedCheckList extends BaseElement
{

    private static $title = "Tabbed Check List Element";

    private static $description = "Tabbed Check List Element";

    private static $has_many = [
        'Tabs' => CheckListTab::class
    ];


    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Tabs');
        $heroconf = GridFieldConfig_RelationEditor::create();
        $heroconf->addComponent(new GridFieldOrderableRows('SortOrder'));
        GridField::create('Tabs', 'Tabs', $this->Tabs(), $heroconf);

        $fields->addFieldToTab('Root.Main',
            GridField::create('Tabs', 'Tabs', $this->Tabs(), $heroconf)
        );

        return $fields;
    }


}