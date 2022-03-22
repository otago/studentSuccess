<?php

namespace OP\Studentsuccess;


use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Control\Email\Email;
use SilverStripe\ORM\DataExtension;


class Contactable extends DataExtension
{

    private static $db = [

        'ContactBoxTitle' => 'Varchar(70)',
        'ContactBoxSubTitle' => 'Varchar(70)',

        'ContactBoxLocationName' => 'Varchar(70)',
        'ContactBoxContent' => 'Varchar(100)',
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


    ];


    public function updateCMSFields(FieldList $fields)
    {

        $fields->addFieldsToTab('Root.Contacts', [
            HeaderField::create('ContactBox')->setTitle('Contact element details, if you dont wish to override these from the global settings, leave blank')->setHeadingLevel(4),
            //TextField::create('ContactBoxTitle')->setTitle('Title'),

            //	TextField::create('ContactBoxPhone')->setTitle('Phone'),
            //	TextField::create('ContactBoxEmail')->setTitle('Email'),


            TextField::create('ContactBoxTitle')->setTitle('Title'),
            TextareaField::create('ContactBoxSubTitle')->setTitle('SubTitle'),


            //Contact 1
            HeaderField::create('ContactBox1')->setTitle('Contact 1'),

            HeaderField::create('ContactBox')->setTitle('Contact 1'),


            TextField::create('ContactBoxLocationName')->setTitle('LocationName'),
            TextareaField::create('ContactBoxContent')->setTitle('Location'),
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

        ]);


    }

    public function ContactBoxLocation()
    {
        return $this->owner->ContactBoxContent;
    }

    public function HasContactableDetails()
    {
        return !empty($this->owner->ContactBoxTitle)
            || !empty($this->owner->ContactBoxContent)
            || !empty($this->owner->ContactBoxPhone)
            || !empty($this->owner->ContactBoxEmail);
    }

}