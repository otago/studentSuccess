<?php

namespace OP\Studentsuccess;


use DNADesign\Elemental\Models\ElementContent;
use OP\Studentsuccess\SidebarTestimony;
use OP\Studentsuccess\SidebarHelp;
use OP\Studentsuccess\SidebarImageElement;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\FieldType\DBField;


class OPElementContentInjector extends ElementContent
{
    protected function provideBlockSchema()
    {

        $myType = "[" . $this->getType() . "] ";
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $myType . $this->getSummary();
        return $blockSchema;
    }

}
