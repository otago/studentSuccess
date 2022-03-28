<?php

namespace OP\Studentsuccess;


use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;


class MasonryContentsWithFilters extends MasonryContent
{
    private static $table_name = 'MasonryContentsWithFilters';
    private static $title = "Masonry Element With Filters";

    private static $description = "Masonry elements with filters";

    private static $inline_editable = false;

    private static $db = [
        'FilterByString' => 'Varchar',
        'SearchFieldDefaultText' => 'Varchar'
    ];
    public function ddd()
    {


        return $this->Tiles();
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        if ($tilesGrid = $fields->dataFieldByName('Tiles')) {
            $configs = $tilesGrid->getConfig();
            $adder = new GridFieldAddNewMultiClass();
            $configs->removeComponentsByType(GridFieldAddNewMultiClass::class);
            $adder->setClasses([
                'FilterableSmallMasonryTile' => 'Text Tile',
                'LinkListMasonryTile' => 'Links List',
                'FilterableSmallMasonryImageTile' => 'Small Image Tile'
            ]);

            $configs->addComponent($adder);
        }


        return $fields;
    }
} 