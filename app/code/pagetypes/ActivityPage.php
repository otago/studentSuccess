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
		'Presentation' => "Enum('TextSlide, SingleChoice, SelectAny, ShowContent, DragAndDrop, DragAndDropToMatch, Paragraph, MultiChoice, Replace, ResultsSlide', 'TextSlide')",
		'Title' => 'Varchar(200)',
		'Description' => 'HTMLText',
		'PresentedOptions' => 'Text',
		'DragAndDropToMatchLabels' => 'Text',
		'CorrectAnswers' => 'Text',
		'RightAnswerContent' => 'HTMLText',
		'WrongAnswerContent' => 'HTMLText',
		'WarningContent' => 'HTMLText',
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

	private static $has_many = array(
		'ContentItems' => 'ActivityPage_Activity_Content'
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
			'TextSlide' => 'Welcome / Instructions',
			'DragAndDrop' => 'Drag & Drop',
			'DragAndDropToMatch' => 'Drag & Drop to Match Text',
			'SingleChoice' => 'Single Choice',
			'Paragraph' => 'Paragraph',
			'MultiChoice' => 'Multi choice list',
			'SelectAny' => 'Select any of the options',
			'Replace' => 'Replace words',
			'ShowContent' => 'Show content based on selection',
			'ResultsSlide' => 'Results Slide'
		));

		$presented = $fields->dataFieldByName('PresentedOptions');
		$presented
			->displayIf('Presentation')->isEqualTo('DragAndDrop')
			->orIf('Presentation')->isEqualTo('DragAndDropToMatch')
			->orIf('Presentation')->isEqualTo('Paragraph')
			->orIf('Presentation')->isEqualTo('SingleChoice')
			->orIf('Presentation')->isEqualTo('MultiChoice')
			->orIf('Presentation')->isEqualTo('SelectAny')
			->orIf('Presentation')->isEqualTo('Replace');

		$presented->setDescription('List the items you want to show the user, separated by new lines. If the user can replace the text on this word then include an * at the end of the word.');

		$correct = $fields->dataFieldByName('CorrectAnswers');

		$correct
			->displayIf('Presentation')->isEqualTo('DragAndDrop')
			->orIf('Presentation')->isEqualTo('DragAndDropToMatch')
			->orIf('Presentation')->isEqualTo('Paragraph')
			->orIf('Presentation')->isEqualTo('SingleChoice')
			->orIf('Presentation')->isEqualTo('MultiChoice')
			->orIf('Presentation')->isEqualTo('Replace');

		$correct->setDescription('List the correct order of the items, separated by new lines');

		$rightContent = $fields->dataFieldByName('RightAnswerContent');
		$rightContent->setRows(4);
		$rightContent
			->displayIf('Presentation')->isEqualTo('DragAndDrop')
			->orIf('Presentation')->isEqualTo('DragAndDropToMatch')
			->orIf('Presentation')->isEqualTo('Paragraph')
			->orIf('Presentation')->isEqualTo('SingleChoice')
			->orIf('Presentation')->isEqualTo('MultiChoice')
			->orIf('Presentation')->isEqualTo('Replace');

		$wrongContent = $fields->dataFieldByName('WrongAnswerContent');
		$wrongContent->setRows(4);
		$wrongContent
			->displayIf('Presentation')->isEqualTo('DragAndDrop')
			->orIf('Presentation')->isEqualTo('DragAndDropToMatch')
			->orIf('Presentation')->isEqualTo('Paragraph')
			->orIf('Presentation')->isEqualTo('SingleChoice')
			->orIf('Presentation')->isEqualTo('SelectAny')
			->orIf('Presentation')->isEqualTo('MultiChoice')
			->orIf('Presentation')->isEqualTo('Replace');

		$warningContent = $fields->dataFieldByName('WarningContent');
		$warningContent->setRows(4);
		$warningContent
			->displayIf('Presentation')->isEqualTo('DragAndDrop')
			->orIf('Presentation')->isEqualTo('DragAndDropToMatch')
			->orIf('Presentation')->isEqualTo('Paragraph')
			->orIf('Presentation')->isEqualTo('SingleChoice')
			->orIf('Presentation')->isEqualTo('MultiChoice')
			->orIf('Presentation')->isEqualTo('Replace');
		
		$matchLabels = $fields->dataFieldByName('DragAndDropToMatchLabels');
		$matchLabels->displayIf('Presentation')->isEqualTo('DragAndDropToMatch');

		$contentItems = $fields->dataFieldByName('ContentItems');
		
		if(!$contentItems) {
			$fields->addFieldToTab('Root.Main', $contentItems = new DisplayLogicWrapper(
				new ReadonlyField('ContentItems', 'You can add content options once you save.')
			));

			$contentItems->displayIf('Presentation')->isEqualTo('ShowContent');
		} else {
			$fields->removeByName('ContentItems');
			$fields->addFieldToTab('Root.Main', $group = new DisplayLogicWrapper(
				$contentItems
			));

			$group->displayIf('Presentation')->isEqualTo('ShowContent');
		}

		return $fields;
	}

	public function getActivityOptions() {
		$options = explode("\n", $this->PresentedOptions);
		$output = new ArrayList();

		if($this->Presentation == "ShowContent") {
			return $this->ContentItems();
		}

		foreach($options as $o) {
			$o = trim($o);

			if($o) {
				$replacable = false;

				if(substr($o, -1) == "*") {
					$o = trim(substr($o, 0, strlen($o) -1));
					$replacable = true;
				}

				$output->push(new ArrayData(array(
					'Title' => $o,
					'IsReplaceable' => $replacable
				)));
			}
		}

		return $output;
	}

	public function getMatchLabels() {
		$options = explode("\n", $this->DragAndDropToMatchLabels);
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

class ActivityPage_Activity_Content	extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(255)',
		'Content' => 'HTMLText'
	);

	private static $has_one = array(
		'ActivityStep' => 'ActivityPage_Activity'
	);
}