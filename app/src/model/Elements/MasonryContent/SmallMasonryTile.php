<?php

namespace OP\Studentsuccess;


use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TreeDropdownField;


class SmallMasonryTile extends MasonryTile
{
    private static $table_name = 'SmallMasonryTile';
    private static $db = [
        'LinkButton' => 'Varchar',
        'SecondaryTarget' => 'Enum("_self,_blank,_modal")',
        'SecondaryLinkURL' => 'Varchar(255)'
    ];

    private static $field_labels = [
        'LinkButton' => 'Secondary Link Title'
    ];

    private static $has_one = [
        'SecondaryPageLink' => SiteTree::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Content');

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