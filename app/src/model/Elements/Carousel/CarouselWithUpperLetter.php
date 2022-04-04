<?php

namespace OP\Studentsuccess;


use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;


class CarouselWithUpperLetter extends Carousel
{
    //private static $table_name = 'CarouselWithUpperLetter';
    private static $title = "Acronym Carousel";

    private static $description = "Carousel Element with upper letter to cycle";

    function getCMSFields()
    {
        $fields = parent::getCMSFields();
        if ($this->ID) {
            if ($slidesGrid = $fields->dataFieldByName('Slides')) {
                $configs = $slidesGrid->getConfig();
                $adder = new GridFieldAddNewMultiClass();
                $configs->removeComponentsByType(GridFieldAddNewMultiClass::class);
                $adder->setClasses([
                    'CarouselSlideWithUpperLetter' => 'Slides with upper letter title and content'
                ]);
                $configs->addComponent($adder);
            }
        }

        return $fields;
    }
}
