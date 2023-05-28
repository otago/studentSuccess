<?php

namespace OP\Studentsuccess;


use DNADesign\Elemental\Models\ElementContent;


class ElementTable extends ElementContent
{

    private static $singular_name = "Full width Table";

    private static $description = "Full width Table";

    public function getType()
    {
        return self::$singular_name;
    }

}
