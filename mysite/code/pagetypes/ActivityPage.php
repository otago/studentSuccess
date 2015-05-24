<?php

/**
 * 
 */
class ActivityPage extends Page {
	
	private static $db = array(
		'ColorScheme' => 'Varchar(200)',
		'Validation' => 'Enum("OnEachStep,OnComplete", "OnComplete")'
	);

	private static $has_many = array(
		'Activities' => 'ActivityPage_Activity'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', new DropdownField('ColorScheme', 'Color Scheme', array(
			'black' => 'Black',
			'blue' => 'Blue'
		)));

		$fields->addFieldToTab('Root.Main', $validation = new DropdownField(
			'Validation', 'Validation method', $this->dbObject('Validation')->enumValues()
		));

		$validation->setDescription('How do you want to mark the activity, on each step would require the user to select the correct answer before proceeding and on complete will wait till the end');

		$config = new GridFieldConfig_RelationEditor();
		$config->addComponent(new GridFieldOrderableRows('Sort'));

		$steps = new GridField('Activities', 'Activities', $this->Activities(), $config);
		
		$fields->addFieldToTab('Root.Main', $steps);

		return $fields;
	}
}


/**
 * 
 */
class ActivityPage_Controller extends Page_Controller {
	
}

/**
 *
 */
class ActivityPage_Activity extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(200)',
		'Description' => 'HTMLText',
		'Presentation' => "Enum('DragAndDrop, Paragraph, MultiChoice, Replace', 'MultiChoice')",
		'PresentedOptions' => 'Text',
		'CorrectAnswers' => 'Text',
		'RightAnswerContent' => 'HTMLText',
		'WrongAnswerContent' => 'HTMLText',
		'Sort' => 'Int'
	);

	private static $summary_fields = array(
		'Title',
		'Presentation',
		'Description'
	);

	private static $has_one = array(
		'Activity' => 'ActivityPage'
	);

	public function i18n_singular_name() {
		return 'Step';
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName('Sort');

		$presented = $fields->dataFieldByName('PresentedOptions');
		$presented->setDescription('List the items you want to show the user, separated by new lines');

		$correct = $fields->dataFieldByName('CorrectAnswers');
		$correct->setDescription('List the correct order of the items, separated by new lines');

		return $fields;
	}

	public function getActivityOptions() {
		$options = explode("\n", $this->PresentedOptions);
		$output = new ArrayList();

		foreach($options as $o) {
			$o = trim($o);

			if($o) {
				$output->push(new ArrayData(array(
					'Title' => $o
				)));
			}
		}

		return $output;
	}
}