<?php

/**
 * 
 */
class ActivityPage extends Page {
	
	private static $db = array(
		'ColorScheme' => 'Varchar(200)',
		'Icon' => 'Enum("pencil, question, none", "none")',
		'MaxAttempts' => 'Int',
		'Validation' => 'Enum("OnEachStep,OnComplete", "OnComplete")'
	);

	private static $has_many = array(
		'Activities' => 'ActivityPage_Activity'
	);

	private static $defaults = array(
		'MaxAttempts' => 3
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', new DropdownField('ColorScheme', 'Color Scheme', array(
			'black' => 'Black',
			'blue' => 'Blue'
		)));

		$fields->addFieldToTab('Root.Main', new DropdownField('Icon', 'Icon', array(
			'none' => 'None',
			'pencil' => 'Pencil',
			'question' => 'Question'
		)));

		if(!$this->MaxAttempts) {
			$this->MaxAttempts = 3;
		}

		$fields->addFieldToTab('Root.Main', new NumericField('MaxAttempts', 'Max attempts'));

		$fields->removeByName('Content');

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
		'Presentation' => "Enum('TextSlide, SingleChoice, DragAndDrop, Paragraph, MultiChoice, Replace, ResultsSlide', 'TextSlide')",
		'Title' => 'Varchar(200)',
		'Description' => 'HTMLText',
		'PresentedOptions' => 'Text',
		'CorrectAnswers' => 'Text',
		'RightAnswerContent' => 'HTMLText',
		'WrongAnswerContent' => 'HTMLText',
		'Sort' => 'Int'
	);

	private static $default_sort = "Sort";

	private static $summary_fields = array(
		'Title',
		'Presentation',
		'Description'
	);

	private static $has_one = array(
		'Activity' => 'ActivityPage'
	);

	private static $field_labels = array(
		'Title' => 'Slide title',
		'Description' => 'Instructions',
		'Presentation' => 'Slide type'
	);

	public function i18n_singular_name() {
		return 'Step';
	}

	public function onBeforeWrite() {
		parent::onBeforeWrite();

		if(!$this->Sort && $this->ActivityID) {
			$parentID = $this->ActivityID;

			$this->Sort = DB::query("SELECT MAX(\"Sort\") + 1 FROM \"ActivityPage_Activity\" WHERE \"ActivityID\" = $parentID")->value();
		}
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->removeByName('Sort');

		$description = $fields->dataFieldByName('Description');
		$description->setRows(4);

		$presentation = $fields->dataFieldByName('Presentation');
		$presentation->setSource(array(
			'TextSlide' => 'Welcome/Instructions',
			'DragAndDrop' => 'DragAndDrop',
			'SingleChoice' => 'SingleChoice',
			'Paragraph' => 'Paragraph',
			'MultiChoice' => 'MultiChoice',
			'Replace' => 'Replace',
			'ResultsSlide' => 'Results'
		));

		$presented = $fields->dataFieldByName('PresentedOptions');
		$presented
			->displayIf('Presentation')->isEqualTo('DragAndDrop')
			->orIf('Presentation')->isEqualTo('Paragraph')
			->orIf('Presentation')->isEqualTo('SingleChoice')
			->orIf('Presentation')->isEqualTo('MultiChoice')
			->orIf('Presentation')->isEqualTo('Replace');

		$presented->setDescription('List the items you want to show the user, separated by new lines');

		$correct = $fields->dataFieldByName('CorrectAnswers');

		$correct
			->displayIf('Presentation')->isEqualTo('DragAndDrop')
			->orIf('Presentation')->isEqualTo('Paragraph')
			->orIf('Presentation')->isEqualTo('SingleChoice')
			->orIf('Presentation')->isEqualTo('MultiChoice')
			->orIf('Presentation')->isEqualTo('Replace');

		$correct->setDescription('List the correct order of the items, separated by new lines');

		$rightContent = $fields->dataFieldByName('RightAnswerContent');
		$rightContent->setRows(4);
		$rightContent
			->displayIf('Presentation')->isEqualTo('DragAndDrop')
			->orIf('Presentation')->isEqualTo('Paragraph')
			->orIf('Presentation')->isEqualTo('SingleChoice')
			->orIf('Presentation')->isEqualTo('MultiChoice')
			->orIf('Presentation')->isEqualTo('Replace');

		$wrongContent = $fields->dataFieldByName('WrongAnswerContent');
		$wrongContent->setRows(4);
		$wrongContent
			->displayIf('Presentation')->isEqualTo('DragAndDrop')
			->orIf('Presentation')->isEqualTo('Paragraph')
			->orIf('Presentation')->isEqualTo('SingleChoice')
			->orIf('Presentation')->isEqualTo('MultiChoice')
			->orIf('Presentation')->isEqualTo('Replace');
			
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

		public function getAnswers() {
		$options = explode("\n", $this->CorrectAnswers);
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