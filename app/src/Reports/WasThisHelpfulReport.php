<?php

namespace OP\studentsuccess;


use Page;
use SilverStripe\Reports\Report;



class WasThisHelpfulReport extends Report {

	public function title() {
		return	'Was this page helpful percentages';
	}

	public function group() {
		return _t('SideReport.ContentGroupTitle', "Content reports");
	}

	public function sort() {
		return 100;
	}

	public function sourceRecords($params = null) {
		return Page::get();
	}

	public function columns() {
		return array(
			"Title" => array(
				"title" => "Title",
				"link" => true,
			),
			"HelpfulCounterYes" => array(
				"title" => "Yes",
				"link" => true,
			),
			"HelpfulCounterNo" => array(
				"title" => "No",
				"link" => true,
			),
			"HelpfulCounterPercentage" => array(
				"title" => "Percentage",
				"link" => true,
			),
		);
	}

} 