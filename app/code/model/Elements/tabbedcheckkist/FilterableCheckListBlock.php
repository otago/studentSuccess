<?php

class FilterableCheckListBlock extends CheckListBlock {

	private static $db = array(
		'AppliesToIam' => 'Varchar(255)',
		'AppliesToMoving' => 'Varchar(255)',
		'AppliesToStudy' => 'Varchar(255)',
		'AppliesToLocations' => 'Varchar(255)',
		'AppliesToFirstTrimester' => 'Boolean',
		'AppliesToSecondTrimester' => 'Boolean'
	);

	private static $has_one = array(
		'FilterableCheckList' => 'FilterableCheckList'
	);

	private static $summary_fields = array(
		'Title',
		'AppliesToIam',
		'AppliesToMoving',
		'AppliesToLocations',
		'AppliesToFirstTrimester'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'AppliesToIam',
			'AppliesToMoving',
			'AppliesToStudy',
			'AppliesToLocations',
			'AppliesToFirstTrimester',
			'AppliesToSecondTrimester'
		));

		$fields->addFieldsToTab('Root.Main', array(
			new CheckboxSetField('AppliesToIam', 'Applies to the following selections', FilterableCheckList::$iam),
			new CheckboxSetField('AppliesToMoving', '', FilterableCheckList::$moving),
			new CheckboxSetField('AppliesToLocations', '', FilterableCheckList::$locations),
			new CheckboxField('AppliesToFirstTrimester'),
			new CheckboxField('AppliesToSecondTrimester'),
		));

		return $fields;
	}
}