<?php

namespace OP\Studentsuccess;


use SilverStripe\Forms\FieldList;
use SilverStripe\View\Requirements;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Assets\File;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\ORM\DataExtension;


class Linkable extends DataExtension
{

    private static $db = [
        'LinkType' => 'Enum("None, Internal, External, File", "None")',
        'InternalLinkID' => 'Int',
        'InternalFileID' => 'Int',
        'ExternalLink' => 'Varchar(300)',
        'Target' => 'Enum("_self,_blank,_modal")',
        'ForceDownload' => 'Boolean'
    ];

    public function updateCMSFields(FieldList $fields)
    {

        Requirements::javascript('sss-core/javascript/Linkable.js');

        $fields->removeByName([
            'LinkType',
            'InternalLinkID',
            'InternalFileID',
            'ExternalLink',
            'Target',
            'ForceDownload'
        ]);

        $fields->addFieldsToTab('Root.Main', [
            HeaderField::create('LinkTitle')->setTitle('Link settings')->setHeadingLevel(3),
            DropdownField::create('LinkType')->setSource([
                'None' => 'None',
                'Internal' => 'Internal',
                'External' => 'External',
                'File' => File::class
            ]),
//			TreeDropdownField::create('InternalLinkID')->setSourceObject(SiteTree::class),
//			TreeDropdownField::create('InternalFileID')->setSourceObject(File::class),
            TextField::create('ExternalLink'),
            DropdownField::create('Target')->setSource([
                '_self' => 'Open in same window',
                '_blank' => 'Open in a new window',
                '_modal' => 'Modal Window'
            ]),
            CheckboxField::create('ForceDownload')
        ]);

    }

    public function Link()
    {

        if ($this->owner->LinkType == 'Internal' && $this->owner->InternalLinkID) {
            $siteTree = SiteTree::get()->byID($this->owner->InternalLinkID);

            return $siteTree ? $siteTree->Link() : '';
        } else if ($this->owner->LinkType == 'External' && $this->owner->ExternalLink) {
            return $this->owner->ExternalLink;
        } else if ($this->owner->LinkType == File::class && $this->owner->InternalFileID) {
            $file = File::get()->byID($this->owner->InternalFileID);

            return $file ? $file->Link() : '';
        }

    }

    public function hasLink()
    {

        if ($this->owner->LinkType == 'Internal' && $this->owner->InternalLinkID) {
            $siteTree = SiteTree::get()->byID($this->owner->InternalLinkID);

            return $siteTree ? $siteTree->Link() : '';
        } else if ($this->owner->LinkType == 'External' && $this->owner->ExternalLink) {
            return $this->owner->ExternalLink;
        } else if ($this->owner->LinkType == File::class && $this->owner->InternalFileID) {
            $file = File::get()->byID($this->owner->InternalFileID);

            return $file ? $file->Link() : '';
        }

    }

    public function OpenInModal()
    {
        return ($this->owner->Target == "_modal");
    }


} 