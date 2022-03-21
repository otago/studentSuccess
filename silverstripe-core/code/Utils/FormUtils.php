<?php

namespace OP\Studentsuccess;




use GridFieldSortableRows;


use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;


/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 4/6/15
 * Time: 8:59 AM
 * To change this template use File | Settings | File Templates.
 */

class FormUtils {


	/**
	 * @param $strName
	 * @param $strLabel
	 * @param $strValue
	 * @return LiteralField
	 */
	public static function GetCMSFieldTypeLiteralField($strName, $strLabel, $strValue){
		return new LiteralField($strName, "<div class='field'>
			<label class='left'>{$strLabel}</label>
			<div class='middleColumn'>
				<p>$strValue</p>
			</div>
		</div>");
	}


	/**
	 * @param $strName
	 * @param $strTitle
	 * @param $dlList
	 * @param $strSortColumn
	 *
	 * make and return a grid field with the components for drag and drop reordering
	 */
	public static function MakeDragAndDropGridField($strName, $strTitle, $dlList, $strSortColumn, $strType = 'RelationEditor', $iPagination = 20){

		if($strType == 'RecordEditor'){
			$gridConfigs = new GridFieldConfig_RecordEditor($iPagination);
		}else{
			$gridConfigs = new GridFieldConfig_RelationEditor($iPagination);
		}
		$gridConfigs->addComponent(new GridFieldSortableRows($strSortColumn));
		return new GridField($strName, $strTitle, $dlList, $gridConfigs);
	}

	/**
	 * @param $strName
	 * @param $strTitle
	 * @param $dlList
	 *
	 */
	public static function MakeRelationSelector($strName, $strTitle, $dlList, $iPagination = 20){
		$gridConfigs = new GridFieldConfig_RelationEditor($iPagination);
		$gridConfigs->removeComponentsByType(GridFieldAddNewButton::class);
		return new GridField($strName, $strTitle, $dlList, $gridConfigs);
	}


	/**
	 * @param $strCSV
	 * @return array
	 */
	public static function CSVToSourceArray($strCSV){
		$arrRet = array();
		$arrItems = explode(',', $strCSV);

		foreach($arrItems as $strVal){
			$strVal = trim($strVal);
			$arrRet[$strVal] = $strVal;
		}

		return $arrRet;
	}

    static function RemoveFields($fields, $arrFields){
        foreach($arrFields as $strFieldName){
            $fields->removeByName($strFieldName);
        }
        return $fields;
    }

    static function AddRelationReadOnlyField($strName, $strTitle, $dataList,$bSortable = true, $strOrderField = "SortOrder"){
        $configs = new GridFieldConfig_RelationEditor(50);
        $configs->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
        $configs->removeComponentsByType(GridFieldAddNewButton::class);
        $oGridField = new GridField($strName, $strTitle, $dataList, $configs);
        return $oGridField;
    }

    static function AddRelationFieldWithoutAddButton($strName, $strTitle, $dataList, $arrSearchFields = null){
        $configs = new GridFieldConfig_RelationEditor(50);
        $configs->removeComponentsByType(GridFieldAddNewButton::class);
        if($arrSearchFields){
            $configs->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
            $autoCompleter = new GridFieldAddExistingAutocompleter("before", $arrSearchFields);
            $configs->addComponent($autoCompleter);
        }
        $oGridField = new GridField($strName, $strTitle, $dataList, $configs);
        return $oGridField;
    }

    static function AddRelationFieldWithoutSearch($strName, $strTitle, $dataList,$bSortable = true, $strOrderField = "SortOrder"){
        $configs = new GridFieldConfig_RelationEditor(50);
        $configs->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
        if($bSortable && !empty($strOrderField)){
            $configs->addComponent(new GridFieldSortableRows($strOrderField));
        }
        $oGridField = new GridField($strName, $strTitle, $dataList, $configs);
        return $oGridField;
    }

} 