<?php

namespace OP\studentsuccess;

use Page;


use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\CMS\Model\SiteTree;
use PageController;


class HomePage extends Page
{
    private static $table_name = 'HomePage';

    private static $db = [
        'HeroTitle' => 'Varchar(100)',
        'HeroContent' => 'Varchar(100)',
        'HeroLinkText' => 'Varchar(30)',
        'HeroLinkType' => 'Enum("None, Internal, External", "None")',
        'HeroInternalLinkID' => 'Int',
        'HeroExternalLink' => 'Varchar(300)',
        'HeroLinkTarget' => 'Enum("_self,_blank")'
    ];

    private static $has_one = [

    ];


    function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldsToTab('Root.Hero', [
            TextareaField::create('HeroTitle'),
            TextareaField::create('HeroContent'),
            HeaderField::create('HeroLinkTitle')->setTitle('Link settings')->setHeadingLevel(3),
            TextField::create('HeroLinkText'),
            DropdownField::create('HeroLinkType')->setSource([
                'None' => 'None',
                'Internal' => 'Internal',
                'External' => 'External'
            ]),
            TreeDropdownField::create('HeroInternalLinkID')->setSourceObject(SiteTree::class),
            TextField::create('HeroExternalLink'),
            DropdownField::create('HeroLinkTarget')->setSource([
                '_self' => '_self',
                '_blank' => '_blank'
            ])

        ]);

        return $fields;
    }

    function HeroTitleHTML()
    {
        return nl2br($this->HeroTitle);
    }

    function HeroContentHTML()
    {
        return nl2br($this->HeroContent);
    }


    function HeroLink()
    {
        if ($this->HeroLinkType == 'Internal' && $this->HeroInternalLinkID) {
            $siteTree = SiteTree::get()->byID($this->HeroInternalLinkID);
            return $siteTree ? $siteTree->Link() : '';
        } elseif ($this->HeroLinkType == 'External' && $this->HeroExternalLink) {
            return $this->HeroExternalLink;
        }
    }

}
