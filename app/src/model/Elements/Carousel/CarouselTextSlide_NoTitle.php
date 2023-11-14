<?php

namespace OP\Studentsuccess;


class CarouselTextSlide_NoTitle extends CarouselTextSlide
{

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Title');

        return $fields;
    }

    public function getTitle()
    {
        return $this->Content;
    }
}
