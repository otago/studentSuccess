<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 10:32 AM
 * To change this template use File | Settings | File Templates.
 */

class SmallMasonryTile extends MasonryTile {

	private static $db = array(
		'LinkButton'		=> 'Varchar'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName('Content');

		return $fields;
	}

} 