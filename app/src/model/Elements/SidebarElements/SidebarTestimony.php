<?php

namespace OP\Studentsuccess;


use DNADesign\Elemental\Models\BaseElement;


class SidebarTestimony extends BaseElement
{
    private static $table_name = 'SidebarTestimony';

    private static $singular_name = "Sidebar quote";
    private static string $icon = 'font-icon-block-quote';
    private static $description = "Sidebar quote";

    private static $db = [
        'TestimonyContent' => 'Text',
        'TestimonyName' => 'Varchar(255)'
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    protected function provideBlockSchema()
    {
        $myType = "[" . $this->getType() . "] ";
        $myType .= $this->TestimonyContent . " ";
        $myType .= $this->TestimonyName;

        $blockSchema = parent::provideBlockSchema();

        $blockSchema['content'] = $myType;

        return $blockSchema;
    }
}
