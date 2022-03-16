<?php

namespace OP\studentsuccess;







use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\TextField;
use SilverStripe\Control\Director;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Control\Controller;



class FilterableTile extends DataExtension {

	private static $db = array(
		'Views'				=> 'Int',
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

	public function viewtile() {
		$id = $this->request->param('ID');

		if($tile = MasonryTile::get()->byID($id)) {
			$tile->Views += 1;
			$tile->write();

			return $this->redirect($tile->Link());
		}

		return $this->httpError(404);
	}
}