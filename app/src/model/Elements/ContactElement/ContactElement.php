<?php

namespace OP\Studentsuccess;


use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;


class ContactElement extends BaseElement
{
    private static $table_name = 'ContactElement';
    private static $singular_name = "Contact Element";

    private static $description = "Contact Element";
    private static string $icon = 'font-icon-torso';

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

        $fields->replaceField('imageType', DropdownField::create('imageType')->setSource([
            'Circle' => 'Circle',
            'Square' => 'Square'
        ]));
        $fields->replaceField('backgroundColour', DropdownField::create('backgroundColour')->setSource([
            'bgGrey' => 'Grey',
            'bgWhite' => 'White'
        ]));
        return $fields;
    }

    protected function provideBlockSchema()
    {
        $myType = "[" . $this->getType() . "] ";
        $myType .= $this->DescriptionText . " ";

        $blockSchema = parent::provideBlockSchema();

        $blockSchema['content'] = $myType;
        if ($this->Image() && $this->Image()->exists()) {
            $blockSchema['fileURL'] = $this->Image()->CMSThumbnail()->getURL();
        }
        return $blockSchema;
    }
}
