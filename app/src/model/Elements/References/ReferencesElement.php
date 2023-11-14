<?php

namespace OP\Studentsuccess;


use DNADesign\Elemental\Models\BaseElement;


class ReferencesElement extends BaseElement
{
    private static $table_name = 'ReferencesElement';
    private static $singular_name = "References Element";
    private static string $icon = 'font-icon-eye';
    private static $description = "References Element";

    private static $db = [
        'reference1' => 'Text',
        'referenceItalics' => 'Text',
        'reference2' => 'Text',
        'reflink' => 'Text',

    ];

    public function getType()
    {
        return self::$singular_name;
    }

    public function getCMSFields()
    {

        $fields = parent::getCMSFields();

        return $fields;
    }

    protected function provideBlockSchema()
    {
        $myType = "[" . $this->getType() . "] ";
        $myType .= $this->reference1 . " ";
        $myType .= $this->referenceItalics . " ";
        $myType .= $this->reference2 . " ";
        $myType .= $this->reflink . " ";

        $blockSchema = parent::provideBlockSchema();

        $blockSchema['content'] = $myType;

        return $blockSchema;
    }
}
