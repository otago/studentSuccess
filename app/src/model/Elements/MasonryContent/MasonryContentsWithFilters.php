<?php

namespace OP\studentsuccess;


use Symbiote\GridFieldExtensions\GridFieldAddNewMultiClass;



class MasonryContentsWithFilters extends MasonryContent {

	private static $title = "Masonry Element With Filters";

	private static $description = "Masonry elements with filters";

	private static $db = array(
		'FilterByString'			=> 'Varchar',
		'SearchFieldDefaultText'	=> 'Varchar'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		if($tilesGrid = $fields->dataFieldByName('Tiles')){
			$configs = $tilesGrid->getConfig();
			$adder = new GridFieldAddNewMultiClass();
			$configs->removeComponentsByType(GridFieldAddNewMultiClass::class);
			$adder->setClasses(array(
				'FilterableSmallMasonryTile'	=> 'Text Tile',
				'LinkListMasonryTile'			=> 'Links List',
				'FilterableSmallMasonryImageTile'=> 'Small Image Tile'
			));

			$configs->addComponent($adder);
		}


		return $fields;
	}
} 