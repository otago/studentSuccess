<?php

namespace OP\Studentsuccess;


use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;


class ContactElement extends BaseElement
{
    private static $table_name = 'ContactElement';
    private static $title = "Contact Element";

    private static $description = "Contact Element";

    private static $db = [
        'FirstName' => 'Varchar',
        'LastName' => 'Varchar',
        'DescriptionText' => 'Text',
        'email' => 'Varchar',
        'Phone' => 'Varchar',
        'imageType' => 'Varchar',

        'backgroundColour' => 'Varchar',
    ];

    private static $has_one = [
        'Image' => Image::class
    ];


    public function getCMSFields()
    {

        $fields = parent::getCMSFields();

        $fields->replaceField('imageType', DropdownField::create('imageType')->setSource([
            'Circle' => 'Circle',
            'Square' => 'Square'
        ]));
        $fields->replaceField('backgroundColour', DropdownField::create('backgroundColour')->setSource([
            'bgGrey' => 'Grey',
            'bgWhite' => 'White'
        ]));
        /*
                $fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));
        */
        return $fields;
    }
} 