<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 10:06 AM
 * To change this template use File | Settings | File Templates.
 */

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
			$configs->removeComponentsByType('GridFieldAddNewMultiClass');
			$adder->setClasses(array(
				'FilterableSmallMasonryTile'	=> 'Small Filter Tile',
				'FilterableMasonryTile'			=> 'Tile',
				'FilterableMasonryImageTile'	=> 'Image Tile',
				'LinkListMasonryTile'			=> 'Links List',
				'FilterableSmallMasonryImageTile'=> 'Small Image Tile'
			));
			$configs->addComponent($adder);
		}


		return $fields;
	}

	function Subjects(){
		$alRet = new ArrayList();
		$ids = $this->Tiles()->column('ID');
		if(count($ids)){
			$strIDs = implode(',', $ids);

			$results = DB::query("
				SELECT DISTINCT Subject AS Subject FROM FilterableMasonryImageTile WHERE ID IN (" . $strIDs . ")
				UNION
				SELECT DISTINCT Subject AS Subject FROM FilterableMasonryTile WHERE ID IN (" . $strIDs . ")
				UNION
				SELECT DISTINCT Subject AS Subject FROM FilterableSmallMasonryTile WHERE ID IN (" . $strIDs . ")
			");

			while($row = $results->next()){
				$strTitle = trim($row['Subject']);
				$strKey = strtoupper($strTitle);

				if(!$alRet->find('Key', $strKey)){
					$alRet->push(new ArrayData(array(
						'Key'		=> $strKey,
						'Title'		=> $strTitle
					)));
				}

			}
		}

		return $alRet;
	}

} 