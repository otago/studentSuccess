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
use UncleCheese\DisplayLogic\Forms\Wrapper;


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
                'File' => 'File'
            ]),

            $internal = Wrapper::create(TreeDropdownField::create('InternalLinkID', 'Internal Link', SiteTree::class)),
            $file = Wrapper::create(TreeDropdownField::create('InternalFileID', 'Internal File', File::class)),
            $external = TextField::create('External Link'),
            DropdownField::create('Target')->setSource([
                '_self' => 'Open in same window',
                '_blank' => 'Open in a new window',
                '_modal' => 'Modal Window'
            ]),
            CheckboxField::create('ForceDownload')
        ]);
        $file
            ->displayIf('LinkType')
            ->isEqualTo('File')
            ->end();

        $internal
            ->displayIf('LinkType')
            ->isEqualTo('Internal')
            ->end();
        $external
            ->displayIf('LinkType')
            ->isEqualTo('External')
            ->end();


    }

    public function Link()
    {
        return $this->hasLink();
    }

    public function hasLink()
    {

        if ($this->owner->LinkType == 'Internal' && $this->owner->InternalLinkID) {
            $siteTree = SiteTree::get()->byID($this->owner->InternalLinkID);

            return $siteTree ? $siteTree->Link() : '';
        } else if ($this->owner->LinkType == 'External' && $this->owner->ExternalLink) {
            return $this->owner->ExternalLink;
        } else if ($this->owner->LinkType == 'File' && $this->owner->InternalFileID) {
            $file = File::get()->byID($this->owner->InternalFileID);

            return $file ? $file->Link() : '';
        }

    }

    public function OpenInModal()
    {
        return ($this->owner->Target == "_modal");
    }


} 