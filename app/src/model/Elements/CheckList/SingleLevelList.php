<?php

namespace OP\Studentsuccess;


class SingleLevelList extends CheckList
{

    private static $singular_name = "Interactive List (Single)";

    private static $description = "Interactive List (Single)";
    private static string $icon = 'font-icon-list';
    public function getType()
    {
        return self::$singular_name;
    }
}
