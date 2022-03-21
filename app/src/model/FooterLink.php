<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\FooterLinkBlock;
use SilverStripe\ORM\DataObject;


/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 10:37 AM
 * To change this template use File | Settings | File Templates.
 */
class FooterLink extends DataObject
{
    private static $table_name = 'FooterLink';
    private static $db = [
        'Title' => 'Varchar',
        'SortOrder' => 'Int'
    ];

    private static $has_one = [
        'FooterLinkBlock' => FooterLinkBlock::class
    ];

    private static $default_sort = 'SortOrder';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            FooterLinkBlock::class,
            'FooterLinkBlockID',
            'SortOrder'
        ]);

        return $fields;
    }

} 