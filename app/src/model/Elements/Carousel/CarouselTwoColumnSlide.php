<?php

namespace OP\Studentsuccess;


use SilverStripe\Forms\TextField;


class CarouselTwoColumnSlide extends CarouselTextSlide
{
    private static $table_name = 'CarouselTwoColumnSlide';
    private static $db = [
        'TitlePrefix' => 'Varchar',
        'RightColTitle' => 'Varchar',
        'RightColContent' => 'HTMLText'
    ];


    function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->insertAfter(
            TextField::create('TitlePrefix')->setTitle('Prefix')->setDescription('Displays above the title'), 'Title'
        );
        return $fields;
    }
}
