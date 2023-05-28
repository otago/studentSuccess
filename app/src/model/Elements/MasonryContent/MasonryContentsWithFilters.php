<?php

namespace OP\Studentsuccess;


use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;


class MasonryContentsWithFilters extends MasonryContent
{
    private static $table_name = 'MasonryContentsWithFilters';
    private static $singular_name = "Masonry Element With Filters";

    private static $description = "Masonry elements with filters";

    private static $inline_editable = false;

    private static $db = [
        'FilterByString' => 'Varchar',
        'SearchFieldDefaultText' => 'Varchar'
    ];


    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        if ($tilesGrid = $fields->dataFieldByName('Tiles')) {
            $configs = $tilesGrid->getConfig();
            $adder = new GridFieldAddNewMultiClass();
            $configs->removeComponentsByType(GridFieldAddNewMultiClass::class);
            $adder->setClasses([
                FilterableSmallMasonryTile::class => 'Text Tile',
                LinkListMasonryTile::class => 'Links List',
                FilterableSmallMasonryImageTile::class => 'Small Image Tile'
            ]);

            $configs->addComponent($adder);
        }


        return $fields;
    }
}
