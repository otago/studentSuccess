<?php

namespace OP\Studentsuccess;


use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;


class CarouselWithUpperLetter extends Carousel
{
    //private static $table_name = 'CarouselWithUpperLetter';
    private static $singular_name = "Acronym Carousel";

    private static $description = "Carousel Element with upper letter to cycle";


    public function getType()
    {
        return self::$singular_name;
    }

    function getCMSFields()
    {
        $fields = parent::getCMSFields();
        if ($this->ID) {
            if ($slidesGrid = $fields->dataFieldByName('Slides')) {
                $configs = $slidesGrid->getConfig();
                $adder = new GridFieldAddNewMultiClass();
                $configs->removeComponentsByType(GridFieldAddNewMultiClass::class);
                $adder->setClasses([
                    CarouselSlideWithUpperLetter::class => 'Slides with upper letter title and content'
                ]);
                $configs->addComponent($adder);
            }
        }

        return $fields;
    }
}
