<?php

namespace OP\Studentsuccess;


use DNADesign\Elemental\Models\ElementContent;


class ElementTable extends ElementContent
{

    private static $singular_name = "Content - Full width";

    private static $description = "Content - Full width";

    public function getType()
    {
        return self::$singular_name;
    }

}
