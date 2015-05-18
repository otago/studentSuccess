<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 12:07 PM
 * To change this template use File | Settings | File Templates.
 */

class WasThisHelpfulReport extends SS_Report {

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
		// return DataObject::get("SiteTree", "\"ClassName\" != 'RedirectorPage' AND (\"Content\" = '' OR \"Content\" IS NULL OR \"Content\" LIKE '<p></p>' OR \"Content\" LIKE '<p>&nbsp;</p>')", '"Title"');
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