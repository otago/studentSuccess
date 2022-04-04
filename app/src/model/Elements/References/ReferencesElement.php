<?php

namespace OP\Studentsuccess;


use DNADesign\Elemental\Models\BaseElement;


class ReferencesElement extends BaseElement
{
    private static $table_name = 'ReferencesElement';
    private static $title = "References Element";

    private static $description = "References Element";

    private static $db = [
        'reference1' => 'Text',
        'referenceItalics' => 'Text',
        'reference2' => 'Text',
        'reflink' => 'Text',

    ];


    public function getCMSFields()
    {

        $fields = parent::getCMSFields();

        return $fields;
    }
} 