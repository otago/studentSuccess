<?php

namespace OP\Studentsuccess;

use Page;


use OP\Studentsuccess\FilterableCheckListBlock;
use OP\Studentsuccess\TabbedCheckList;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Control\Cookie;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\Form;
use PageController;
use OP\Studentsuccess\FormUtils;


class FilterableCheckListController extends PageController
{

    private static $allowed_actions = [
        'CheckForm',
        'reset'
    ];

    public function CheckForm()
    {
        $cookie = Cookie::get('Completed' . $this->ID);

        if ($cookie) {
            return;
        }

        if ($this->DisableFilters) {
            return false;
        }

        $fields = new FieldList(
            $iam = new DropdownField('iam', 'I am', FilterableCheckList::$iam),
            $moving = new DropdownField('moving', '', FilterableCheckList::$moving),
            $location = new DropdownField('location', 'to study', FilterableCheckList::$locations),
            $starting = new DropdownField('starting', 'starting', FilterableCheckList::get_starting_dates())
        );

        $actions = new FieldList(
            new FormAction('doForm', 'How do I get ready?')
        );

        $iam->setEmptyString('please select');
        $moving->setEmptyString('please select');
        $location->setEmptyString('please select');

        $required = new RequiredFields([
            'iam',
            'moving',
            'starting',
        ]);

        return new Form($this, 'CheckForm', $fields, $actions, $required);
    }

    public function doForm($data, $form)
    {
        Cookie::set('Completed' . $this->ID, serialize($data));

        return $this->redirect($this->Link());
    }

    public function reset()
    {
        Cookie::force_expiry('Completed' . $this->ID);

        return $this->redirect($this->Link());
    }

}