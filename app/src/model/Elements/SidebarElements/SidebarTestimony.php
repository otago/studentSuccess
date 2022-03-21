<?php

namespace OP\Studentsuccess;


use DNADesign\Elemental\Models\BaseElement;


class SidebarTestimony extends BaseElement
{
    private static $table_name = 'SidebarTestimony';

    private static $title = "Sidebar quote";

    private static $description = "Sidebar quote";

    private static $db = [
        'TestimonyContent' => 'Text',
        'TestimonyName' => 'Varchar(255)'
    ];

} 