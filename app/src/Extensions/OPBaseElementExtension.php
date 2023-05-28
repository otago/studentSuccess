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


class OPBaseElementExtension extends DataExtension
{

    public static $has_open_wrapper = false;

    public static $sidebar_first = null;

    private $allowed = [
        ElementContent::class,
        ElementFile::class,
        ElementLink::class,
        Accordion::class,
        Carousel::class,
        CaseStudy::class,
        CheckList::class,
        ContactElement::class,
        CTAElement::class,
        HearFromOthers::class,
        WayFinder::class
    ];

    private $sidebarClasses = [
        SidebarTestimony::class,
        SidebarHelp::class,
        SidebarImageElement::class
    ];

    function HasSidebar()
    {
        $bRet = false;

        $arrSidebarClasses = $this->sidebarClasses;

        $after = BaseElement::get()->filter([
            'ParentID' => $this->owner->ParentID,
            'ID:not' => $this->owner->ID,
            'Sort:GreaterThan' => $this->owner->Sort,
        ])->sort('Sort', 'ASC')->first();

        if (($after && in_array($after->ClassName, $arrSidebarClasses))) {
            $bRet = true;
        }

        return $bRet;
    }

    function NextIsMoreContent()
    {
        $bRet = false;

        $arrSidebarClasses = $this->allowed;

        $after = BaseElement::get()->filter([
            'ParentID' => $this->owner->ParentID,
            'ID:not' => $this->owner->ID,
            'Sort:GreaterThan' => $this->owner->Sort,
        ])->sort('Sort', 'ASC')->first();

        if (($after && in_array($after->ClassName, $arrSidebarClasses))) {
            $bRet = true;
        }

        return $bRet;
    }

    function ShouldHaveWrapper()
    {
        $should = strpos($this->owner->ClassName, 'Sidebar') !== false;

        if (!self::$has_open_wrapper) {
            if ($should) {
                self::$has_open_wrapper = true;
                self::$sidebar_first = true;

                return true;
            } else {
                // or if this is a generic content component and the next one contains
                // a side element then we should
                if (in_array($this->owner->ClassName, $this->allowed) && $this->HasSidebar()) {
                    self::$has_open_wrapper = true;
                    self::$sidebar_first = false;

                    return true;
                }
            }
        }

        return false;
    }

    function ShouldCloseWrapper()
    {
        if (!self::$has_open_wrapper) {
            return false;
        }

        $sidebar = strpos($this->owner->ClassName, 'Sidebar') !== false;

        if (self::$sidebar_first && !$sidebar && !$this->NextIsMoreContent()) {
            self::$has_open_wrapper = false;
            self::$sidebar_first = null;

            return true;
        }

        if (!self::$sidebar_first && !$this->HasSidebar()) {
            self::$has_open_wrapper = false;
            self::$sidebar_first = null;

            return true;
        }

        return false;
    }

    public function updateCMSFields(FieldList $fields)
    {
        $bob = TextField::create("asdf","Element Type:")
            ->setReadonly(true)
            ->setValue($this->owner->i18n_singular_name());

        $fields->addFieldToTab('Root.Main', $bob, "Title");

    }

}
