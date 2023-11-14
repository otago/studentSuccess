<?php

namespace OP\Studentsuccess;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Forms\TextareaField;

/**
 * Stolen from "dnadesign/silverstripe-elemental": "1.9.4"
 * @package elemental
 */
class ElementFile extends BaseElement
{
    private static $table_name = 'ElementFile';
    private static $db = [
        'FileDescription' => 'Text'
    ];

    private static $has_one = [
        'File' => File::class
    ];

    private static $singular_name = "File Element";

    private static $enable_title_in_template = true;

    private static string $icon = 'font-icon-block-file';

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {

            $desc = TextareaField::create('FileDescription', 'Description');
            $desc->setRightTitle('Optional');
            $fields->addFieldToTab('Root.Main', $desc);

            $uploadField = UploadField::create('File', 'File')
                ->setAllowedMaxFileNumber(1)
                ->setFolderName('Uploads/files');
            $fields->addFieldToTab('Root.Main', $uploadField);
        });

        return parent::getCMSFields();
    }

    protected function provideBlockSchema()
    {
        $myType = "[" . $this->getType() . "] ";
        $myType .= $this->FileDescription . " ";
        $myType .= "'" . $this->File()->title . "' <" . $this->File()->Filename . ">";
//        $myType .= $this->TestimonyName;

//        if ($this->InternalLink()->getAbsoluteLiveLink()) {
//            $myType .= $this->InternalLink()->getAbsoluteLiveLink(false);
//        } else {
//            $myType .= $this->LinkURL;
//        }
//        foreach ($this->Links()->limit(5) as $item) {
//            $myType .= "$item->title, ";
//        }
//        $myType = rtrim($myType, ', ');

        $blockSchema = parent::provideBlockSchema();
//DBField::create_field('HTMLText', $this->HTML)->Summary(20);
        $blockSchema['content'] = $myType;
//
        return $blockSchema;
    }
}
