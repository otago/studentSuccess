<?php

namespace OP\Studentsuccess;


use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Core\Config\Config;
use SilverStripe\SiteConfig\SiteConfig;
use DNADesign\Elemental\Models\BaseElement;


class CTAElement extends BaseElement
{
    private static $table_name = 'CTAElement';
    private static $title = "Call To Action";

    private static $description = "Call To Action";

    private static $db = [
        'DisplayTitle' => 'Varchar',
        'Color' => 'Varchar',
        'Icon' => 'Varchar',
        'ButtonText' => 'Varchar',
        'CTAContent' => 'Text',
    ];

    private static $has_one = [
        'Image' => Image::class
    ];

    public function MyImage()
    {

        return "hello world";
        return $this->Image()->URL;
    }

    public function getCMSFields()
    {

        $fields = parent::getCMSFields();

        $fields->replaceField('Color', DropdownField::create('Color')->setSource([
            'orange' => 'Orange (Default)',
            'black' => 'Black'
        ]));

        $fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get(SiteConfig::class, 'Icons')));

        return $fields;
    }
} 