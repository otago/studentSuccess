<?php

namespace OP\studentsuccess;


use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;


class RelatedPageBox extends DataObject
{
    private static $table_name = 'RelatedPageBox';
    private static $db = [
        'Title' => 'Varchar(255)',
        'LinkButton' => 'Varchar(255)',
        'Icon' => 'Varchar(255)',
        'SortOrder' => 'Int',
        'SecondaryTarget' => 'Enum("_self,_blank,_modal")',
        'SecondaryLinkURL' => 'Varchar(255)'
    ];

    private static $has_one = [
        'Page' => 'Page',
        'SecondaryPageLink' => SiteTree::class
    ];

    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder',
            'Page',
            'PageID',
            'Icon',
            'SecondaryLinkURL'
        ]);

        // $fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get('SiteConfig', 'Icons')));
        $fields->removeByName('LinkButton');
        $fields->removeByName('SecondaryPageLinkID');
        $fields->removeByName('SecondaryTarget');

        $fields->addFieldsToTab('Root.Main', [
            new HeaderField('SecondaryLinkHeading', 'Secondary Link'),
            new TextField('LinkButton', 'Link Title'),
            new DropdownField('SecondaryTarget', 'Target', [
                '_self' => 'Open in same window',
                '_blank' => 'Open in new window',
                '_modal' => 'Modal Window'
            ]),
            new TreeDropdownField('SecondaryPageLinkID', 'Link Page', SiteTree::class),
            new TextField('SecondaryLinkURL')
        ]);

        return $fields;
    }

} 