<?php

namespace OP\studentsuccess;



use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\ORM\HasManyList;
use DNADesign\Elemental\Models\ElementalArea;



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ElementalAreaExtension
 *
 * @author alastairn
 */
class ElementalAreaExtension extends ElementalArea {
    
    public function Elements()
    {
        $result = $this->getComponents('Widgets');

        if (count($result)==0)
            return $result;
        $list = new HasManyList(BaseElement::class, $result->getForeignKey());
        $list->setDataModel($this->model);
        $list->sort('Sort ASC');

        $list = $list->forForeignID($this->ID);
        $list = $list->filter(array(
            'Enabled' => 1
        ));

        return $list;
    }
}
