<?php

namespace OP\Studentsuccess;


use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\TextField;
use SilverStripe\Control\Director;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\TextareaField;
use DNADesign\Elemental\Models\BaseElement;


/**
 * Stolen from "dnadesign/silverstripe-elemental": "1.9.4"
 * @package elemental
 */
class ElementLink extends BaseElement
{
    private static $table_name = 'ElementLink';
    private static $db = [
        'LinkText' => 'Varchar(255)',
        'LinkDescription' => 'Text',
        'LinkURL' => 'Varchar(255)',
        'NewWindow' => 'Boolean'
    ];

    private static $has_one = [
        'InternalLink' => SiteTree::class
    ];

    private static $title = "Link Element";

    private static $description = "";

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            $url = TextField::create('LinkURL', 'Link URL');
            $url->setRightTitle('Including protocol e.g: ' . Director::absoluteBaseURL());
            $fields->addFieldToTab('Root.Main', $url);


            $fields->addFieldsToTab('Root.Main', [
                TreeDropdownField::create('InternalLinkID', 'Link To', SiteTree::class),
                CheckboxField::create('NewWindow', 'Open in a new window'),
                $text = TextField::create('LinkText', 'Link Text'),
                $desc = TextareaField::create('LinkDescription', 'Link Description')
            ]);
        });

        return parent::getCMSFields();
    }
}
