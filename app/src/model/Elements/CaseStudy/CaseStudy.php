<?php

namespace OP\Studentsuccess;


use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;


class CaseStudy extends BaseElement
{
    private static $table_name = 'CaseStudy';
    private static $title = "Case Study";

    private static $description = "Case Study";

    private static $db = [
        'Color' => 'Varchar',
        'Summary' => 'Text',
        'CaseStudyContent' => 'HTMLText'
    ];

    private static $has_one = [
        'Image' => Image::class
    ];

    private static $field_labels = [
        'Summary' => 'Pull quote'
    ];

    protected $enable_title_in_template = true;

    function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Color');

        $fields->addFieldToTab('Root.Main', DropdownField::create('Color')->setSource([
            'green' => 'Green',
            'red' => 'Red',
            'blue' => 'Blue'
        ]));

        return $fields;
    }

} 