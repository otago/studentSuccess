<?php

namespace OP\studentsuccess;


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

    private static $title = "Image Element";

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            $uploadField = UploadField::create(Image::class, Image::class)
                ->setAllowedFileCategories('image')
                ->setAllowedMaxFileNumber(1)
                ->setFolderName('Uploads/images');
            $fields->addFieldToTab('Root.Main', $uploadField);

            $caption = HTMLEditorField::create('Caption', 'Caption');
            $caption->setRightTitle('Optional');

            $fields->addFieldToTab('Root.Main', $caption);
        });

        return parent::getCMSFields();
    }
}
