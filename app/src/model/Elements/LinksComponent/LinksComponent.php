<?php

namespace OP\Studentsuccess;


use SilverStripe\Assets\Image;
use OP\Studentsuccess\LinkElement;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\FormUtils;


class LinksComponent extends BaseElement
{
    private static $table_name = 'LinksComponent';
    private static $title = "Group of links";

    private static $description = "Shows a list of links";

    private static $db = [
        'DisplayContent' => 'HTMLText',
        'Color' => 'Varchar'
    ];

    private static $has_one = [
        'Image' => Image::class
    ];

    private static $many_many = [
        'Links' => LinkElement::class
    ];

    private static $many_many_extraFields = [
        'Links' => [
            'SortOrder' => 'Int'
        ]
    ];

    public function getType()
    {
        return 'Group of links';
    }

    protected $enable_title_in_template = true;

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Links');

        $fields->replaceField('Color', DropdownField::create('Color')->setSource([
            'blue' => 'Blue (Default)',
            'red' => 'Red',
            'green' => 'Green'
        ]));

        if ($this->ID) {
            $fields->addFieldToTab('Root.Main', FormUtils::MakeDragAndDropGridField('Links', 'Links', $this->OrderedLinks(), 'SortOrder', 'RecordEditor'));
        }

        return $fields;
    }

    public function OrderedLinks()
    {
        return $this->Links()->sort('SortOrder');
    }


}