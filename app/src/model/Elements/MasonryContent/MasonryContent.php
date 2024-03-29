<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\MasonryTile;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\FormUtils;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


class MasonryContent extends BaseElement
{
    private static $table_name = 'MasonryContent';
    private static $singular_name = "Masonry Element";

    private static string $icon = 'font-icon-thumbnails';

    private static $description = "Masonry elements";

    private static $db = [
        'DisplayTitle' => 'Varchar',
        'Intro' => 'Text',
        'ShowContacts' => 'Boolean'
    ];

    private static $has_many = [
        'Tiles' => MasonryTile::class
    ];
    private static $inline_editable = false;

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Tiles');

        $heroconf = GridFieldConfig_RelationEditor::create(100);
        $heroconf->addComponent(new GridFieldOrderableRows('SortOrder'));


        $fields->addFieldsToTab('Root.Main', [
            $grid = GridField::create('Tiles', 'Tiles', $this->Tiles(), $heroconf)
        ]);

        $configs = $grid->getConfig();
        $adder = new GridFieldAddNewMultiClass();
        $adder->setClasses([
            MasonryTile::class => 'Tile',
            MasonryImageTile::class => 'Image Tile',
            LinkListMasonryTile::class => 'Links List',
            SmallMasonryTile::class => 'Small text only title'
        ]);
        $configs->removeComponentsByType(GridFieldAddNewButton::class);
        $configs->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
        $configs->addComponent($adder);

        return $fields;
    }

    protected function provideBlockSchema()
    {
        $myType = "[" . $this->getType() . "] ";

        $blockSchema = parent::provideBlockSchema();

        $blockSchema['content'] = $myType;

        return $blockSchema;
    }
}
