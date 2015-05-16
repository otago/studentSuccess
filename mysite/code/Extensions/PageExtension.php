<?php

class PageExtension extends DataExtension {

	private static $db = array(
		'ShowInTopMenu'			=> 'Boolean',
		'AlignRightTopMenu'		=> 'Boolean',
		'HighlightInMenu'		=> 'Boolean',

		// drop down menu contents
		'DropDownMenuTitle'		=> 'Varchar(300)',
		'DropDownCol1'			=> 'HTMLText',
		'DropDownCol2'			=> 'HTMLText',
		'DropDownCol3'			=> 'HTMLText',
		'DropDownLink'			=> 'Varchar(200)',

		'HelpfulCounterYes'		=> 'Int',
		'HelpfulCounterNo'		=> 'Int',

		'RelatedTopicsTitle'	=> 'Varchar(200)',
		'ShowRelatedTopicsContacts'	=> 'Boolean'
	);

	private static $has_one = array(
		'DropDownImage'			=> 'Image',
		'HeroImage'				=> 'Image',

		// content areas
		'BeforeElementArea' 	=> 'ElementalArea',
		'AfterElementArea' 		=> 'ElementalArea',
		'SidebarElementArea' 	=> 'ElementalArea'
	);


	private static $has_many = array(
		'RelatedPages'			=> 'RelatedPage',
		'RelatedBoxes'			=> 'RelatedPageBox'
	);


	/**
	 * @param FieldList $fields
	 */
	public function updateSettingsFields(FieldList $fields){
		$fields->addFieldsToTab("Root.Settings", array(
			CheckboxField::create('ShowInTopMenu'),
			CheckboxField::create('AlignRightTopMenu'),
			CheckboxField::create('HighlightInMenu'),
		), 'ShowInSearch');
	}


	/**
	 * @param FieldList $fields
	 */
	public function updateCMSFields(FieldList $fields){

		// hero
		$fields->addFieldToTab('Root.Hero', UploadField::create('HeroImage'));

		$fields->addFieldsToTab('Root.Main', array(
			LiteralField::create('WasThisHelpful', "<p>Was this help ful ? {$this->owner->HelpfulCounterYes} - YES | {$this->owner->HelpfulCounterNo} - NO</p>")
		));

		$fields->addFieldsToTab('Root.Dropdown', array(
			TextField::create('DropDownMenuTitle')->setTitle('Title'),
			HtmlEditorField::create('DropDownCol1')->setTitle('Column 1 Content')->setRows(5),
			HtmlEditorField::create('DropDownCol2')->setTitle('Column 2 Content')->setRows(5),
			HtmlEditorField::create('DropDownCol3')->setTitle('Column 3 Content')->setRows(5),
			UploadField::create('DropDownImage'),
			TextField::create('DropDownLink')
		));


		if($elementalGridField = $fields->dataFieldByName('ElementArea')){
			$configs = $elementalGridField->getConfig();
			$configs->removeComponentsByType('GridFieldDeleteAction');
		}

		$this->AddElementalAreas($fields);

		$this->AddRelatedTopicsFields($fields);
	}

	function AddRelatedTopicsFields(FieldList $fields){

		$fields->addFieldsToTab('Root.RelatedTopics', array(
			TextField::create('RelatedTopicsTitle'),
			CheckboxField::create('ShowRelatedTopicsContacts')->setTitle('Show contacts'),
			FormUtils::MakeDragAndDropGridField('RelatedPages', 'RelatedPages', $this->owner->RelatedPages(), 'SortOrder'),
			FormUtils::MakeDragAndDropGridField('RelatedBoxes', 'RelatedBoxes', $this->owner->RelatedBoxes(), 'SortOrder')
		));

	}


	/**
	 * @param FieldList $fields
	 */
	function AddElementalAreas(FieldList $fields){

		foreach(array('BeforeElementArea', 'AfterElementArea', 'SidebarElementArea') as $strArea){

			if(is_array($this->owner->config()->get('allowed_elements'))) {
				$list = $this->owner->config()->get('allowed_elements');
			} else {
				$classes = ClassInfo::subclassesFor('BaseElement');
				$list = array();
				unset($classes['BaseElement']);

				foreach($classes as $class) {
					$list[$class] = singleton($class)->i18n_singular_name();
				}
			}

			asort($list);

			$area = $this->owner->$strArea();

			if($area->isInDB()){

				$strTitle = 'Above content area';
				if($strArea == 'AfterElementArea')
					$strTitle = 'Below Content Area';
				if($strArea == 'SidebarElementArea')
					$strTitle = 'Side bar';

				$adder = new GridFieldAddNewMultiClass();

				$header = HeaderField::create('Header_' . $strArea);
				$header->setTitle($strTitle);
				$header->setHeadingLevel(3);
				$fields->addFieldToTab('Root.Main', $header);

				$gridField = GridField::create($strArea,
					Config::inst()->get("ElementPageExtension",'elements_title'),
					$this->owner->$strArea()->Elements(),
					GridFieldConfig_RelationEditor::create()
						->removeComponentsByType('GridFieldAddNewButton')
						->removeComponentsByType('GridFieldAddExistingAutocompleter')
						->removeComponentsByType('GridFieldDeleteAction')
						->addComponent($adder)
						->addComponent(new GridFieldOrderableRows())
				);

				$config = $gridField->getConfig();
				$paginator = $config->getComponentByType('GridFieldPaginator');
				$paginator->setItemsPerPage(100);

				$config->removeComponentsByType('GridFieldDetailForm');
				$config->addComponent(new VersionedDataObjectDetailsForm());

				$fields->addFieldToTab('Root.Main', $gridField);
			}

		}

	}


	public function onBeforeWrite() {

		foreach(array('BeforeElementArea', 'AfterElementArea', 'SidebarElementArea') as $strArea){
			$elements = $this->owner->$strArea();
			if(!$elements->isInDB()) {
				$elements->write();
				$this->owner->setField($strArea . 'ID', $elements->ID);
			}
		}

		parent::onBeforeWrite();
	}


	function HasRelatedTopics(){
		return $this->owner->RelatedBoxes()->count() > 0 || $this->owner->RelatedPages()->count() > 0;
	}


	function HasDropdownContents(){
		return $this->owner->DropDownMenuTitle
			|| $this->owner->DropDownCol1
			|| $this->owner->DropDownCol2
			|| $this->owner->DropDownCol3
			|| $this->owner->DropDownImageID;
	}

	function BreadCrumbPages($maxDepth = 20, $unlinked = false, $stopAtPageType = false, $showHidden = false) {
		$page = $this->owner;
		$pages = array();

		while(
			$page
			&& (!$maxDepth || count($pages) < $maxDepth)
			&& (!$stopAtPageType || $page->ClassName != $stopAtPageType)
		) {
			if($showHidden || $page->ShowInMenus || ($page->ID == $this->owner->ID)) {
				$pages[] = $page;
			}

			$page = $page->Parent;
		}

		$list = new ArrayList(array_reverse($pages));
		return $list;
	}

	/**
	 * @return string
	 */
	function NavigationClass(){
		$classes = array(
			'page'
		);

		if($this->owner->HighlightInMenu){
			$classes[] = 'button';
		}


		if($this->owner->LinkOrSection() == 'section'){
			$classes[] = 'active';
		}

		return implode(' ', $classes);
	}

} 