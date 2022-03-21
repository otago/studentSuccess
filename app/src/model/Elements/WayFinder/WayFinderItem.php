<?php

namespace OP\Studentsuccess;


use SilverStripe\Forms\DropdownField;
use SilverStripe\Core\Config\Config;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\ORM\DataObject;


class WayFinderItem extends DataObject
{
    private static $table_name = 'WayFinderItem';
    private static $db = [
        'Title' => 'Varchar',
        'Description' => 'Text',
        'Icon' => 'Varchar'
    ];

    private static $summary_fields = [
        'Icon',
        'Title',
        'Description'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Icon');
        $fields->addFieldsToTab('Root.Main', DropdownField::create('Icon')->setSource(
            Config::inst()->get(SiteConfig::class, 'Icons')
        )->setEmptyString('None'));


        $fields->addFieldsToTab('Root.Settings', [
            //CheckboxSetField::create('ManyMany[Filters]')->setTitle('Filters')
            //	->setSource(WayFinderFilter::get()->map()->toArray()),
            DropdownField::create('ManyMany[Size]')->setSource([
                'col-1' => 'One Column',
                'col-2' => 'Two Columns',
                'col-3' => 'Three Columns'
            ]),
            DropdownField::create('ManyMany[Background]')->setSource([
                'lighter-blue' => 'Blue',
                'light-green' => 'Green',
                'getting-started' => 'Yellow'
            ])
        ]);

        return $fields;
    }

    function Render()
    {
        return $this->renderWith($this->ClassName);
    }

} 