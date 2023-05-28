<?php

namespace OP\Studentsuccess;


use DNADesign\Elemental\Models\BaseElement;


class SidebarTestimony extends BaseElement
{
    private static $table_name = 'SidebarTestimony';

    private static $singular_name = "Sidebar quote";

    private static $description = "Sidebar quote";

    private static $db = [
        'TestimonyContent' => 'Text',
        'TestimonyName' => 'Varchar(255)'
    ];

    public function getType()
    {
        return self::$singular_name;
    }
}
