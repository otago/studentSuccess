<?php

class FilterableCheckList extends Page {

	private static $has_many = array(
		'Blocks'			=> 'FilterableCheckListBlock'
	);

	public static $iam = array(
		'domestic' => 'a domestic student',
		'international' => 'an international student'
	);

	public static $moving = array(
		'overseas' => 'moving from overseas',
		'nz' => 'moving within NZ',
		'local' => 'not moving'
	);

	public static $locations = array(
		'Dunedin' => 'in Dunedin',
		'Central' => 'in Central',
		'Auckland' => 'in Auckland',
		'Online' => 'Online'
	);

	public  function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'SortOrder',
			'Content',
			'TabbedCheckList',
			'TabbedCheckListID',
			'Blocks'
		));

		$fields->addFieldToTab('Root.Main', FormUtils::MakeDragAndDropGridField('Blocks', 'Blocks', $this->Blocks(), 'SortOrder', 'RecordEditor'));

		return $fields;
	}

	public static function get_starting_dates() {

		$starting = array();
		$current = date('m');

		if($current >= 7) {
			$starting[date('M', strtotime('February'))] = date('M Y', strtotime('February'));
			$starting[date('M',strtotime('July'))] = date('M Y', strtotime('July'));
		} else {
			$starting[date('M',strtotime('July'))] = date('M Y', strtotime('July'));
			$starting[date('M', strtotime('February'))] = date('M Y', strtotime('February next year'));
		}

		return $starting;
	}


	public function CorrectBlocks() {
		$settings = Cookie::get('Completed'. $this->ID);

		if(!$settings) {
			return null;
		}

		$settings = unserialize($settings);

		$blocks = $this->Blocks()->filter(array(
			'AppliesToIam:PartialMatch' => $settings['iam'],
			'AppliesToMoving:PartialMatch' => $settings['moving']
		));

		if(isset($settings['location'])) {
			$blocks = $blocks->filter(array(
				'AppliesToLocations:PartialMatch' => $settings['location']
			));
		}

		if($settings['starting'] == "Jul") {
			$blocks = $blocks->filter('AppliesToSecondTrimester', true);
		}
		else if($settings['starting'] == "Feb") {
			$blocks = $blocks->filter('AppliesToFirstTrimester', true);
		}

		return $blocks;
	}
}

class FilterableCheckList_Controller extends Page_Controller {
	
	private static $allowed_actions = array(
		'CheckForm',
		'reset'
	);

	public function CheckForm() {
		$cookie = Cookie::get('Completed'. $this->ID);

		if($cookie) {
			return;
		}

		$fields = new FieldList(
			$iam = new DropdownField('iam', 'I am', FilterableCheckList::$iam),
			$moving = new DropdownField('moving', '', FilterableCheckList::$moving),
			$location = new DropdownField('location', 'to study', FilterableCheckList::$locations),
			$starting = new DropdownField('starting', 'starting', FilterableCheckList::get_starting_dates())
		);

		$actions = new FieldList(
			new FormAction('doForm', 'How do I get ready?')
		);

		$iam->setEmptyString('please select');
		$moving->setEmptyString('please select');
		$location->setEmptyString('please select');

		$required = new RequiredFields(array(
			'iam',
			'moving',
			'starting',
		));

		return new Form($this, 'CheckForm', $fields, $actions, $required);
	}

	public function doForm($data, $form) {
		Cookie::set('Completed'. $this->ID, serialize($data));

		return $this->redirect($this->Link());
	}

	public function reset() {
		Cookie::force_expiry('Completed'. $this->ID);

		return $this->redirect($this->Link());
	}

}