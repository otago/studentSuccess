<?php

class GlossaryType extends DataObject {

	private static $db = array(
		'Title'			=> 'Varchar(255)',
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

	public function Letters() {
		$alRet = new ArrayList();

		$results = DB::query("SELECT SUBSTRING(UPPER(Title), 1, 1) AS Letter
			FROM GlossaryItem WHERE GlossaryTypeID = " . $this->ID . " GROUP BY Letter ORDER BY Letter")->column();

		$letters = range('a', 'z');

		for($i = 0; $i < count($results); $i++) {
			$letter = $results[$i];
			$title = $results[$i];
			$pos = array_search(strtolower($title), $letters);

			if($i == count($results) - 1) {
				// no next so the title is the end of the range;
				$following = array_slice($letters, $i);
			} else {
				$nextPos = array_search(strtolower($results[$i+1]), $letters);

				$following = array_slice($letters, $pos, ($nextPos - $pos));
			}

			if(count($following) > 1) {
				$title .= ' - '. strtoupper(array_pop($following));
			}

			$alRet->push(new ArrayData(array(
				'Letter'		=> $letter,
				'Title'			=> $title,
				'Items'			=> $this->Items()->filter('Title:StartsWith', $letter)->sort('Title')
			)));
		}


		return $alRet;
	}


} 