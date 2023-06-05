<?php

namespace OP\Studentsuccess;


class SidebarImageElement extends ElementImage
{

    private static $singular_name = "Sidebar Image";

    public function getType()
    {
        return self::$singular_name;
    }

}
