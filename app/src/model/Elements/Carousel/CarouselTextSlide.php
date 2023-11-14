<?php

namespace OP\Studentsuccess;


class CarouselTextSlide extends CarouselSlide
{
    private static $table_name = 'CarouselTextSlide';
    private static $db = [
        'Content' => 'HTMLText'
    ];
}
