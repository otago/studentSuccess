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
    private static $singular_name = "Call To Action";
    private static string $icon = 'font-icon-block-bell';
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

    private static $owns = [
        'Image'
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {

        $fields = parent::getCMSFields();

        $fields->replaceField('Color', DropdownField::create('Color')->setSource([
            'tpdark-green' => 'Dark Green',
            'tpmediumgreen' => 'Medium Green',
            'tplightgreen' => 'Light Green',
            'tpstone' => 'Stone',
            'tpmaroon' => 'Maroon',
            'black' => 'Black'
        ]));

        $fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get(SiteConfig::class, 'Icons')));

        return $fields;
    }

    protected function provideBlockSchema()
    {
        $myType = "[" . $this->getType() . "] ";
        $myType .= $this->CTAContent . " ";

        $blockSchema = parent::provideBlockSchema();

        $blockSchema['content'] = $myType;
        if ($this->Image() && $this->Image()->exists()) {
            $blockSchema['fileURL'] = $this->Image()->CMSThumbnail()->getURL();
        }
        return $blockSchema;
    }
}
