<?php

namespace OP\Studentsuccess;


class SingleLevelCheckList extends CheckList
{

    private static $singular_name = "Interactive Checklist (Single)";

    private static $description = "Interactive Checklist (Single)";

    public function getType()
    {
        return self::$singular_name;
    }
}
