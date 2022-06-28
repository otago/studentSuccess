<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\Contactable;
use DNADesign\Elemental\Models\BaseElement;


class SidebarHelp extends BaseElement
{
    private static $table_name = 'SidebarHelp';

    private static $title = "Sidebar Help";

    private static $description = "Sidebar Help";

    private static $extensions = [
        Contactable::class
    ];

    public function getType()
    {
        return 'Sidebar Help';
    }
}