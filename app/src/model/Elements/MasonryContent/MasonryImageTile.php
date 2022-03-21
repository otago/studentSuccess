<?php

namespace OP\Studentsuccess;

use SilverStripe\Assets\Image;


/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 9:24 AM
 * To change this template use File | Settings | File Templates.
 */
class MasonryImageTile extends MasonryTile
{
    private static $table_name = 'MasonryImageTile';
    private static $db = [
        'HideTitle' => 'Boolean'
    ];

    private static $has_one = [
        'Image' => Image::class
    ];

} 