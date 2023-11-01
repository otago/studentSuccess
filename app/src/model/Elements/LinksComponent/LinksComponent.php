<?php

namespace OP\Studentsuccess;


use SilverStripe\Assets\Image;
use OP\Studentsuccess\LinkElement;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\FormUtils;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


class LinksComponent extends BaseElement
{
    private static $table_name = 'LinksComponent';
    private static $singular_name = "Group of links";
    private static string $icon = 'font-icon-link';

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

    private static $owns = [
        'Links',
        'Image',
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    private static $inline_editable = false;
    protected $enable_title_in_template = true;

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Links');

        $fields->replaceField('Color', DropdownField::create('Color')->setSource([
            'tpmaroon' => 'Maroon (Default)',
            'tpstone' => 'Stone',
            'tpmediumgreen' => 'Medium Green'
        ]));

        if ($this->ID) {
            $heroconf = GridFieldConfig_RelationEditor::create();
            $heroconf->addComponent(new GridFieldOrderableRows('SortOrder'), new GridFieldButtonRow());

            $fields->addFieldToTab('Root.Main', GridField::create('Links', 'Links', $this->OrderedLinks(), $heroconf));

        }

        return $fields;
    }

    public function OrderedLinks()
    {
        return $this->Links()->sort('SortOrder');
    }


}
