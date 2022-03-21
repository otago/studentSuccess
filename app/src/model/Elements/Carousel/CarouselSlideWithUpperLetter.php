<?php

namespace OP\Studentsuccess;


class CarouselSlideWithUpperLetter extends CarouselTextSlide
{
    private static $table_name = 'CarouselSlideWithUpperLetter';
    private static $db = [
        'UpperLetter' => 'Varchar(1)'
    ];
}
