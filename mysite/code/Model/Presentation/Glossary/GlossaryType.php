<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 2:12 PM
 * To change this template use File | Settings | File Templates.
 */

class GlossaryType extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar',
		'SortOrder'		=> 'Int'
	);

	private static $has_one = array(
		'Page'			=> 'GlossaryPage'
	);

	private static $has_many = array(
		'Items'			=> 'GlossaryItem',
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'Page',
			'PageID',
			'Items'
		));

		$fields->addFieldToTab('Root.Main',
			FormUtils::MakeDragAndDropGridField('Items', 'Items', $this->Items(), 'SortOrder', 'RecordEditor', 200)
		);

		return $fields;
	}

	function Letters(){
		$alRet = new ArrayList();

		$results = DB::query("SELECT SUBSTRING(UPPER(Title), 1, 1) AS Letter
			FROM GlossaryItem WHERE GlossaryTypeID = " . $this->ID . " GROUP BY Letter ORDER BY Letter");

		while($row = $results->next()){
			$alRet->push(new ArrayData(array(
				'Letter'		=> $row['Letter'],
				'Items'			=> $this->Items()->filter('Title:StartsWith', $row['Letter'])->sort('Title')
			)));
		}


		return $alRet;
	}


} 