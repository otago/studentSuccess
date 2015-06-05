<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 10:25 AM
 * To change this template use File | Settings | File Templates.
 */

class FilterableTile extends DataExtension {

	private static $db = array(
		'Views'				=> 'Int',
		'Subject'			=> 'Varchar'
	);

	public function updateCMSFields(FieldList $fields){
		$fields->removeByName('Views');
		$fields->addFieldToTab('Root.Main', HeaderField::create('Views')->setTitle('Views: ' . $this->owner->Views)->setHeadingLevel(3));
		$fields->addFieldToTab('Root.Main', TextField::create('Subject'));
	}

	public function CounterLink(){
		if($this->owner->Link()){
			return Director::baseURL() . 'tile/viewtile/' . $this->owner->ID;
		}
	}

}

class FilterableTile_Counter extends Controller {

	private static $allowed_actions = array(
		'viewtile'
	);

	function viewtile(){
		$id = $this->request->param('ID');
		if($tile = MasonryTile::get()->byID($id)){
			$tile->Views += 1;
			$tile->write();
			return $this->redirect($tile->Link());
		}

		return $this->httpError(404);
	}


}