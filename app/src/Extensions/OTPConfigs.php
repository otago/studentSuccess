<?php

namespace OP\Studentsuccess;












use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Control\Email\Email;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\ORM\DataExtension;
use OP\Studentsuccess\FormUtils;




class OTPConfigs extends DataExtension
{

    private static $db = array(
        'TelephoneInternational' => 'Varchar',
        'TelephoneNewZealand' => 'Varchar',
        'ContactEmail' => 'Varchar',
        'AddressCol1' => 'Text',
        'AddressCol2' => 'Text',
        'AddressCol3' => 'Text',


        'ContactBoxTitle' => 'Varchar(70)',
        'ContactBoxSubTitle' => 'Varchar(70)',

        'ContactBoxLocationName' => 'Varchar(70)',
        'ContactBoxLocation' => 'Varchar(100)',
        'ContactBoxPhone' => 'Varchar',
        'ContactBoxEmail' => 'Varchar',

        'ContactBoxLocationName2' => 'Varchar(70)',
        'ContactBoxLocation2' => 'Varchar(100)',
        'ContactBoxPhone2' => 'Varchar',
        'ContactBoxEmail2' => 'Varchar',

        //  'OtherDetails'                                  => 'Varchar',
        'ContactBoxLocationName3' => 'Varchar(70)',
        'ContactBoxLocation3' => 'Varchar(100)',
        'ContactBoxPhone3' => 'Varchar',
        'ContactBoxEmail3' => 'Varchar',

        'CreativeCommonsLicence' => 'HTMLText',
        'FeedBackLiteOn' => 'Boolean',
        'FeedBackLite' => 'HTMLFragment'

    );

    private static $has_one = array(
        'CreativeCommonsLicenceImage' => Image::class,
    );

    public function updateCMSFields(FieldList $fields)
    {

        $fields->addFieldsToTab('Root.Contacts', array(


            TextField::create('ContactBoxTitle')->setTitle('Title'),

            TextareaField::create('ContactBoxSubTitle')->setTitle('SubTitle'),
            HeaderField::create('ContactBox')->setTitle('Contact 1'),


            TextField::create('ContactBoxLocationName')->setTitle('LocationName'),
            TextareaField::create('ContactBoxLocation')->setTitle('Location'),
            TextField::create('ContactBoxPhone')->setTitle('Phone'),
            TextField::create('ContactBoxEmail')->setTitle(Email::class),

            HeaderField::create('ContactBox2')->setTitle('Contact 2'),
            TextField::create('ContactBoxLocationName2')->setTitle('LocationName'),
            TextareaField::create('ContactBoxLocation2')->setTitle('Location'),
            TextField::create('ContactBoxPhone2')->setTitle('Phone 2'),
            TextField::create('ContactBoxEmail2')->setTitle('Email 2'),

            HeaderField::create('ContactBox3')->setTitle('Contact 3'),
            TextField::create('ContactBoxLocationName3')->setTitle('LocationName'),
            TextareaField::create('ContactBoxLocation3')->setTitle('Location'),
            TextField::create('ContactBoxPhone3')->setTitle('Phone 3'),
            TextField::create('ContactBoxEmail3')->setTitle('Email 3'),
        ));


        $uploadField = UploadField::create('CreativeCommonsLicenceImage')
            ->setAllowedFileCategories('image')
            ->setAllowedMaxFileNumber(1);
        $caption = HTMLEditorField::create('CreativeCommonsLicence');



        $LinkBlocksGrid = GridField::create('LinkBlocks', 'Link Blocks', FooterLinkBlock::get(), GridFieldConfig_RelationEditor::create());
        $fields->addFieldsToTab('Root.Footer.Top', array(
            $LinkBlocksGrid,

            $uploadField,

            $caption

        ));

        $fields->addFieldToTab("Root.Main", new CheckboxField('FeedBackLiteOn', 'FeedBackLiteOn'));
        $fields->addFieldToTab("Root.Main", new TextareaField('FeedBackLite', 'FeedBackLite'));

        $fields->addFieldsToTab('Root.Footer.Bottom', array(
            TextField::create('TelephoneInternational'),
            TextField::create('TelephoneNewZealand'),
            TextField::create('ContactEmail'),
            TextareaField::create('AddressCol1'),
            TextareaField::create('AddressCol2'),
            TextareaField::create('AddressCol3')
        ));
    }


    function AddressCol1HTML()
    {
        return nl2br($this->owner->AddressCol1);
    }

    function AddressCol2HTML()
    {
        return nl2br($this->owner->AddressCol2);
    }

    function AddressCol3HTML()
    {
        return nl2br($this->owner->AddressCol3);
    }


    /**
     * @return ArrayList
     */
    function GetFooterLinks()
    {
        $iLinks = FooterLink::get()->count();
        $iPerCol = floor($iLinks / 3);
        $alRet = new ArrayList();

        $iCounter = 0;
        $col = null;
        foreach (FooterLinkBlock::get() as $block) {

            if ((!$col || $iCounter >= $iPerCol) && $alRet->count() != 3) {
                $col = new ArrayData(array(
                    'Blocks' => new ArrayList()
                ));
                $alRet->push($col);
                $iCounter = 0;
            }


            $col->Blocks->push($block);
            $iCounter += $block->Links()->count();
        }

        return $alRet;
    }

} 