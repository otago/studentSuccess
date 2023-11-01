<?php

namespace OP\Studentsuccess;



use OP\Studentsuccess\CarouselSlide;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use DNADesign\Elemental\Models\BaseElement;
use OP\Studentsuccess\FormUtils;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;


class Carousel extends BaseElement
{
    private static $table_name = 'Carousel';
    private static $singular_name = "Carousel";
    private static string $icon = 'font-icon-block-carousel';

    private static $description = "Carousel";

    private static $db = [
        'Background' => 'Varchar'
    ];

    private static $has_many = [
        'Slides' => CarouselSlide::class
    ];
    public function getType()
    {
        return self::$singular_name;
    }

    private static $owns = [
        'Slides'
    ];

    private static $inline_editable = false;

    function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Slides');

        $fields->replaceField('Background', DropdownField::create('Background')->setSource([
            'blue' => 'Blue (Default)',
            'red' => 'Red',
            'green' => 'Green',
            'gray' => 'Gray'
        ]));

        if ($this->ID) {
            $heroconf = GridFieldConfig_RelationEditor::create();
            $heroconf->addComponent(new GridFieldOrderableRows('SortOrder'), new GridFieldButtonRow());

            $fields->addFieldsToTab('Root.Main', [
                   $grid = GridField::create('Slides', 'Slides', $this->Slides(), $heroconf)
            ]);

            $configs = $grid->getConfig();
            $adder = new GridFieldAddNewMultiClass();
            $adder->setClasses([
                CarouselSlide::class => 'Slide with only a title',
                CarouselTextSlide::class => 'Slide with title and content',
                CarouselTextSlide_NoTitle::class => 'Slide with just content',
                CarouselTwoColumnSlide::class => 'Slide with two columns of content'
            ]);
            $configs->removeComponentsByType(GridFieldAddNewButton::class);
            $configs->addComponent($adder);
        }

        return $fields;
    }



}
