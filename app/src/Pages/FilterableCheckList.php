<?php

namespace OP\studentsuccess;

use Page;


use OP\studentsuccess\FilterableCheckListBlock;
use OP\studentsuccess\TabbedCheckList;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Control\Cookie;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\Form;
use PageController;
use OP\studentsuccess\FormUtils;


class FilterableCheckList extends Page
{

    private static $table_name = 'FilterableCheckList';

    private static $db = [
        'DisableFilters' => 'Boolean'
    ];

    private static $has_many = [
        'Blocks' => FilterableCheckListBlock::class
    ];

    public static $iam = [
        'domestic' => 'a domestic student',
        'international' => 'an international student'
    ];

    public static $moving = [
        'overseas' => 'moving from overseas',
        'nz' => 'moving within NZ',
        'local' => 'not moving'
    ];

    public static $locations = [
        'Dunedin' => 'in Dunedin',
        'Central' => 'in Central',
        'Auckland' => 'in Auckland',
        'Online' => 'Online'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName([
            'SortOrder',
            'Content',
            TabbedCheckList::class,
            'TabbedCheckListID',
            'Blocks'
        ]);

        $fields->addFieldToTab('Root.Main', new CheckboxField('DisableFilters'));
        $fields->addFieldToTab('Root.Main', FormUtils::MakeDragAndDropGridField('Blocks', 'Blocks', $this->Blocks(), 'SortOrder', 'RecordEditor'));

        return $fields;
    }

    public static function get_starting_dates()
    {

        $starting = [];
        $current = date('m');

        if ($current >= 7) {
            $starting[date('M', strtotime('February'))] = date('M Y', strtotime('February'));
            $starting[date('M', strtotime('July'))] = date('M Y', strtotime('July'));
        } else {
            $starting[date('M', strtotime('July'))] = date('M Y', strtotime('July'));
            $starting[date('M', strtotime('February'))] = date('M Y', strtotime('February next year'));
        }

        return $starting;
    }


    public function CorrectBlocks()
    {
        if ($this->DisableFilters) {
            return $this->Blocks();
        }

        $settings = Cookie::get('Completed' . $this->ID);

        if (!$settings) {
            return null;
        }

        $settings = unserialize($settings);

        $blocks = $this->Blocks()->filter([
            'AppliesToIam:PartialMatch' => $settings['iam'],
            'AppliesToMoving:PartialMatch' => $settings['moving']
        ]);

        if (isset($settings['location'])) {
            $blocks = $blocks->filter([
                'AppliesToLocations:PartialMatch' => $settings['location']
            ]);
        }

        if ($settings['starting'] == "Jul") {
            $blocks = $blocks->filter('AppliesToSecondTrimester', true);
        } else if ($settings['starting'] == "Feb") {
            $blocks = $blocks->filter('AppliesToFirstTrimester', true);
        }

        return $blocks;
    }
}
