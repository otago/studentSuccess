<?php

namespace OP\Studentsuccess;


use DNADesign\Elemental\Models\BaseElement;


class MatrixElement extends BaseElement
{
    private static $table_name = 'MatrixElement';
    private static $singular_name = "Matrix of Four blocks";

    private static $description = "Matrix of Four blocks";
    private static $casting = [
        'OverlayHTML' => 'HTMLFragment'
    ];

    private static $db = [
        'LabelLeftTop' => 'Varchar',
        'LabelLeftBottom' => 'Varchar',
        'LabelTopLeft' => 'Varchar',
        'LabelTopRight' => 'Varchar',


        // contents
        'CellTopLeftTitle' => 'Text',
        'CellTopLeftContent' => 'Text',
        'OverlayTopLeft' => 'Text',
        'CellTopRightTitle' => 'Text',
        'CellTopRightContent' => 'Text',
        'OverlayTopRight' => 'Text',
        'CellBottomLeftTitle' => 'Text',
        'CellBottomLeftContent' => 'Text',
        'OverlayBottomLeft' => 'Text',
        'CellBottomRightTitle' => 'Text',
        'CellBottomRightContent' => 'Text',
        'OverlayBottomRight' => 'Text'
    ];

    public function getType()
    {
        return self::$singular_name;
    }

    function OverlayHTML($strField)
    {
        $strContents = $this->getField($strField);
        if ($strContents) {
            $arrLines = explode("\n", $strContents);
            return "<ul><li>" . implode("</li><li>", $arrLines) . "</li></ul>";
        }
    }

}
