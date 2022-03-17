<?php

namespace OP\studentsuccess;


use OP\studentsuccess\LinkListMasonryTile;
use OP\studentsuccess\FilterableSmallMasonryTile;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\ORM\DataObject;


class MasonryTileLink extends DataObject
{
    private static $table_name = 'MasonryTileLink';
    private static $db = [
        'Title' => 'Varchar',
        'SortOrder' => 'Int'
    ];

    private static $has_one = [
        'LinkListMasonryTile' => LinkListMasonryTile::class
    ];

    private static $many_many = [
        'Elements' => FilterableSmallMasonryTile::class
    ];

    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            LinkListMasonryTile::class,
            'LinkListMasonryTileID',
            'SortOrder',
            'Elements'
        ]);

        if ($this->LinkListMasonryTile()->exists()) {
            $tiles = FilterableSmallMasonryTile::get()
                ->filter([
                    'MasonryContentID' => $this->LinkListMasonryTile()->MasonryContentID
                ])
                ->sort('Title ASC')->map('ID', 'Title');

            $fields->addFieldToTab('Root.Main', CheckboxSetField::create('Elements', 'Elements', $tiles));
        }

        return $fields;
    }

} 