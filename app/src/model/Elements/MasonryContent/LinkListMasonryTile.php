<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\MasonryTileLink;
use OP\Studentsuccess\FormUtils;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


class LinkListMasonryTile extends MasonryTile
{
    private static $table_name = 'LinkListMasonryTile';
    private static $has_many = [
        'Links' => MasonryTileLink::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'Content'
        ]);
        $heroconf = GridFieldConfig_RelationEditor::create();
        $heroconf->addComponent(new GridFieldOrderableRows('SortOrder'), new GridFieldButtonRow());

        $fields->addFieldToTab('Root.Main',
            GridField::create('Links', 'Links', $this->Links(), $heroconf)
        );

        return $fields;

    }
} 
