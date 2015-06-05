<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 9:18 AM
 * To change this template use File | Settings | File Templates.
 */

class MasonryContent extends BaseElement {

	private static $title = "Masonry Element";
	private static $description = "Masonry elements";

	private static $db = array(
		'DisplayTitle'			=> 'Varchar',
		'Intro'					=> 'Text',
		'ShowContacts'			=> 'Boolean'
	);

	private static $has_many = array(
		'Tiles'					=> 'MasonryTile'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('Tiles');

		$fields->addFieldsToTab('Root.Main', array(
			$grid = FormUtils::MakeDragAndDropGridField('Tiles', 'Tiles', $this->Tiles(), 'SortOrder', 'RecordEditor')
		));

		$configs = $grid->getConfig();
		$adder = new GridFieldAddNewMultiClass();
		$adder->setClasses(array(
			'MasonryTile'			=> 'Tile',
			'MasonryImageTile'		=> 'Image Tile',
			'LinkListMasonryTile'	=> 'Links List',
			'SmallMasonryTile'		=> 'Small Tile With Title'
		));
		$configs->removeComponentsByType('GridFieldAddNewButton');
		$configs->removeComponentsByType('GridFieldAddExistingAutocompleter');
		$configs->addComponent($adder);

		return $fields;
	}

} 