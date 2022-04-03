<?php

namespace OP\Studentsuccess;
//
//
//
//use DNADesign\Elemental\Models\BaseElement;
//use SilverStripe\ORM\HasManyList;
//use DNADesign\Elemental\Models\ElementalArea;
//use SilverStripe\Widgets\Model\Widget;
//
///*
// * To change this license header, choose License Headers in Project Properties.
// * To change this template file, choose Tools | Templates
// * and open the template in the editor.
// */
//
///**
// * Description of ElementalAreaExtension
// *
// * @author alastairn
// */
use DNADesign\Elemental\Models\ElementalArea;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;

class ElementalAreaExtension extends ElementalArea {

    public function getOwnerPage()
    {
        // You can't find the owner page of a area that hasn't been save yet
        if (!$this->isInDB()) {
            return null;
        }

        // Allow for repeated calls to read from cache
        if (isset($this->cacheData['owner_page'])) {
            return $this->cacheData['owner_page'];
        }

        if ($this->OwnerClassName && ClassInfo::exists($this->OwnerClassName)) {
            $class = $this->OwnerClassName;
            $instance = Injector::inst()->get($class);
            if (!ClassInfo::hasMethod($instance, 'getElementalRelations')) {
                return null;
            }
            $elementalAreaRelations = $instance->getElementalRelations();

            foreach ($elementalAreaRelations as $eaRelationship) {
                $areaID = $eaRelationship . 'ID';

                $table = DataObject::getSchema()->tableForField($class, $areaID);
                $baseTable = DataObject::getSchema()->baseDataTable($class);
                $page = DataObject::get_one($class, [
                    "\"{$table}\".\"{$areaID}\" = ?" => $this->ID,
                    "\"{$baseTable}\".\"ClassName\" = ?" => $class
                ]);

                if ($page) {
                    $this->setOwnerPageCached($page);
                    return $page;
                }
            }
        }

        foreach ($this->supportedPageTypes() as $class) {
            $instance = Injector::inst()->get($class);
            if (!ClassInfo::hasMethod($instance, 'getElementalRelations')) {
                return null;
            }

            $areaIDFilters = [];
            foreach ($instance->getElementalRelations() as $eaRelationship) {
                $areaIDFilters[$eaRelationship . 'ID'] = $this->ID;
            }

            try {
                $page = Versioned::get_by_stage($class, Versioned::DRAFT)->filterAny($areaIDFilters)->first();
            } catch (\Exception $ex) {
                // Usually this is catching cases where test stubs from other modules are trying to be loaded
                // and failing in unit tests.
                if (in_array(TestOnly::class, class_implements($class))) {
                    continue;
                }
                // Continue as normal...
                throw $ex;
            }

            if ($page) {
                if ($this->OwnerClassName !== $class) {
                    $this->OwnerClassName = $class;

                    // Avoid recursion: only write if it's already in the database
                    if ($this->isInDB()) {
                        $this->write();
                    }
                }

                $this->cacheData['area_relation_name'] = $page;
                return $page;
            }
        }

        return null;
    }
}
