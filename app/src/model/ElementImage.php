<?php

namespace OP\Studentsuccess;


use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;


/**
 * Stolen from "dnadesign/silverstripe-elemental": "1.9.4"
 * Image tiles can link to a certain page.
 *
 * @package elemental
 */
class ElementImage extends ElementLink
{
    private static $table_name = 'ElementImage';
    private static $db = [
        'Caption' => 'HTMLText'
    ];

    private static $has_one = [
        'Image' => Image::class
    ];

    private static $title = "Inline image";

    private static $owns = [
        'Image'
    ];

    public function getType()
    {
        return 'Inline image';
    }
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            $caption = HTMLEditorField::create('Caption', 'Caption');
            $caption->setRightTitle('Optional');

            $fields->addFieldToTab('Root.Main', $caption);
        });

        return parent::getCMSFields();
    }
}