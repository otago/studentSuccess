<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 9:20 AM
 * To change this template use File | Settings | File Templates.
 */

class MasonryTile extends DataObject {

	private static $db = array(
		'Title'				=> 'Varchar',
		'Content'			=> 'Text',
		'SortOrder'			=> 'Int',
	);

	private static $has_one = array(
		'MasonryContent'	=> 'MasonryContent'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'MasonryContent',
			'MasonryContentID'
		));

		return $fields;
	}

	public function Render(){
		return $this->renderWith($this->ClassName);
	}

} 