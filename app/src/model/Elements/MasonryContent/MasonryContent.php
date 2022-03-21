<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\MasonryTile;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\FormUtils;


class MasonryContent extends BaseElement
{
    private static $table_name = 'MasonryContent';
    private static $title = "Masonry Element";

    private static $description = "Masonry elements";

    private static $db = [
        'DisplayTitle' => 'Varchar',
        'Intro' => 'Text',
        'ShowContacts' => 'Boolean'
    ];

    private static $has_many = [
        'Tiles' => MasonryTile::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Tiles');

        $fields->addFieldsToTab('Root.Main', [
            $grid = FormUtils::MakeDragAndDropGridField('Tiles', 'Tiles', $this->Tiles(), 'SortOrder', 'RecordEditor')
        ]);

        $configs = $grid->getConfig();
        $adder = new GridFieldAddNewMultiClass();
        $adder->setClasses([
            'MasonryTile' => 'Tile',
            'MasonryImageTile' => 'Image Tile',
            'LinkListMasonryTile' => 'Links List',
            'SmallMasonryTile' => 'Small text only title'
        ]);
        $configs->removeComponentsByType(GridFieldAddNewButton::class);
        $configs->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
        $configs->addComponent($adder);

        return $fields;
    }

} 