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

    private static $singular_name = "Tabbed Check List Element";
    private static string $icon = 'font-icon-block-form';
    private static $description = "Tabbed Check List Element";
    private static $inline_editable = false;
    private static $has_many = [
        'Tabs' => CheckListTab::class
    ];

    public function getType()
    {
        return self::$singular_name;
    }

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

    protected function provideBlockSchema()
    {
        $myType = "[" . $this->getType() . "] ";

        foreach ($this->Tabs()->limit(5) as $item) {
            $myType .= "$item->title, ";
        }
        $myType = rtrim($myType, ', ');

        $blockSchema = parent::provideBlockSchema();

        $blockSchema['content'] = $myType;

        return $blockSchema;
    }

}
