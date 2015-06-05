<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 10:11 AM
 * To change this template use File | Settings | File Templates.
 */

class LinkListMasonryTile extends MasonryTile {

	private static $has_many = array(
		'Links'			=> 'MasonryTileLink'
	);

	public function getCMSFields(){

		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'Content'
		));

		$fields->addFieldToTab('Root.Main', FormUtils::MakeDragAndDropGridField('Links', 'Links', $this->Links(), 'SortOrder', 'RecordEditor'));

		return $fields;

	}



} 