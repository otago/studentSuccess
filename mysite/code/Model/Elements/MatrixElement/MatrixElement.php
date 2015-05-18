<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 8:00 AM
 * To change this template use File | Settings | File Templates.
 */

class MatrixElement extends BaseElement {

	private static $title = "Matrix of Four blocks";

	private static $description = "Matrix of Four blocks";

	private static $db = array(
		'LabelLeftTop'			=> 'Varchar',
		'LabelLeftBottom'		=> 'Varchar',
		'LabelTopLeft'			=> 'Varchar',
		'LabelTopRight'			=> 'Varchar',


		// contents
		'CellTopLeftTitle'		=> 'Text',
		'CellTopLeftContent'	=> 'Text',
		'OverlayTopLeft'		=> 'Text',
		'CellTopRightTitle'		=> 'Text',
		'CellTopRightContent'	=> 'Text',
		'OverlayTopRight'		=> 'Text',
		'CellBottomLeftTitle'	=> 'Text',
		'CellBottomLeftContent'	=> 'Text',
		'OverlayBottomLeft'		=> 'Text',
		'CellBottomRightTitle'	=> 'Text',
		'CellBottomRightContent'=> 'Text',
		'OverlayBottomRight'	=> 'Text'
	);


	function OverlayHTML($strField){
		$strContents = $this->getField($strField);
		if($strContents){
			$arrLines = explode("\n", $strContents);
			return "<ul><li>" . implode("</li><li>", $arrLines) . "</li></ul>";
		}
	}

} 