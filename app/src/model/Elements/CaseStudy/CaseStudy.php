<?php

namespace OP\Studentsuccess;


use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\ORM\FieldType\DBField;


class CaseStudy extends BaseElement
{
    private static $table_name = 'CaseStudy';
    private static $singular_name = "Case Study";

    private static string $icon = 'font-icon-address-card';

    private static $description = "Case Study";

    private static $db = [
        'Color' => 'Varchar',
        'SummaryQuote' => 'Text',
        'CaseStudyContent' => 'HTMLText'
    ];

    private static $has_one = [
        'Image' => Image::class
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    private static $owns = [
        'Image'
    ];

    protected $enable_title_in_template = true;

    function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Color');

        $fields->addFieldToTab('Root.Main', DropdownField::create('Color')->setSource([
            'tpdark-green' => 'Dark Green',
            'tpmediumgreen' => 'Medium Green',
            'tplightgreen' => 'Light Green',
            'tpmaroon' => 'Maroon',
            'tpstone' => 'Stone'
        ]));

        return $fields;
    }

    protected function provideBlockSchema()
    {
        $myType = "[" . $this->getType() . "] ";
        $myType .= DBField::create_field('HTMLText', $this->CaseStudyContent)->Summary(20) . " ";


        $blockSchema = parent::provideBlockSchema();

        $blockSchema['content'] = $myType;
        if ($this->Image() && $this->Image()->exists()) {
            $blockSchema['fileURL'] = $this->Image()->CMSThumbnail()->getURL();
        }
        return $blockSchema;
    }

}
