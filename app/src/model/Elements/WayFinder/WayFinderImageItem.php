<?php

namespace OP\Studentsuccess;

use SilverStripe\Assets\Image;


class WayFinderImageItem extends WayFinderItem
{
    private static $table_name = 'WayFinderImageItem';
    private static $has_one = [
        'Image' => Image::class
    ];

    private static $owns = [
        'Image'
    ];

    public function Thumbnail(){
        return $this->Image()->ScaleHeight(100);
    }
}
