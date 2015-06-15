<?php

class Page extends SiteTree {

	private static $db = array(
		'MetaTitle'		=> 'Varchar(255)',
		'Intro'				=> 'Text',
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
	);


	private static $has_many = array(
		'RelatedPages'			=> 'RelatedPage',
		'RelatedBoxes'			=> 'RelatedPageBox'
	);

	public function updateSettingsFields() {
		$fields = parent::updateSettingsFields();

		$fields->addFieldsToTab("Root.Settings", array(
			CheckboxField::create('ShowInTopMenu'),
			CheckboxField::create('AlignRightTopMenu'),
			CheckboxField::create('HighlightInMenu'),
		), 'ShowInSearch');

		return $fields;
	}



	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$metaData = $fields->fieldByName('Root.Main.Metadata');

		if($metaData) {
			$metaData->push(new TextField('MetaTitle', 'Meta title'));
		}
		else{
			$fields->addFieldToTab("Root.Main", new TextField('MetaTitle', 'Meta title'));
		}

		$fields->insertAfter(new TextareaField('Intro', 'Page Intro'), 'MenuTitle');

		// hero
		$fields->addFieldToTab('Root.Hero', UploadField::create('HeroImage'));

		$fields->addFieldsToTab('Root.Helpful', array(
			LiteralField::create('WasThisHelpful', "<h4>Was this helpful ? {$this->HelpfulCounterYes} - YES | {$this->HelpfulCounterNo} - NO</h4>")
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

		$fields->removeByName('Contacts');

		$fields->addFieldsToTab('Root.RelatedTopics', array(
			TextField::create('RelatedTopicsTitle'),
			CheckboxField::create('ShowRelatedTopicsContacts')->setTitle('Show contacts'),
			FormUtils::MakeDragAndDropGridField('RelatedPages', 'RelatedPages', $this->RelatedPages(), 'SortOrder'),
			FormUtils::MakeDragAndDropGridField('RelatedBoxes', 'RelatedBoxes', $this->RelatedBoxes(), 'SortOrder'),
			HeaderField::create('ContactBox')->setTitle('Contact element details, if you dont wish to override these from the global settings, leave blank')->setHeadingLevel(4),
			TextField::create('ContactBoxTitle')->setTitle('Title'),
			TextareaField::create('ContactBoxContent')->setTitle('Content'),
			TextField::create('ContactBoxPhone')->setTitle('Phone'),
			TextField::create('ContactBoxEmail')->setTitle('Email'),
		));

		$this->extend('updateCMSFieldsForImages', $fields);

		return $fields;
	}


	public function canView($member = null) {
		if($this->URLSegment == 'SearchPage') {
			return true;
		}

		return parent::canView($member);
	}


	function canViewStage($stage = 'Live', $member = null){
		if($this->URLSegment == 'SearchPage')
			return true;

		return parent::canViewStage($stage, $member);
	}

	function HasRelatedTopics(){
		return $this->RelatedBoxes()->count() > 0 || $this->RelatedPages()->count() > 0;
	}


	function HasDropdownContents() {
		return $this->DropDownMenuTitle
			|| $this->DropDownCol1
			|| $this->DropDownCol2
			|| $this->DropDownCol3
			|| $this->DropDownImageID;
	}

	function BreadCrumbPages($maxDepth = 20, $unlinked = false, $stopAtPageType = false, $showHidden = false) {
		$page = $this;
		$pages = array();

		while(
			$page
			&& (!$maxDepth || count($pages) < $maxDepth)
			&& (!$stopAtPageType || $page->ClassName != $stopAtPageType)
		) {
			if($showHidden || $page->ShowInMenus || ($page->ID == $this->ID)) {
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
	public function NavigationClass() {
		$classes = array(
			'page'
		);

		if($this->HighlightInMenu){
			$classes[] = 'button';
		}


		if($this->LinkOrSection() == 'section'){
			$classes[] = 'active';
		}

		return implode(' ', $classes);
	}


	public function HelpfulCounterPercentage() {
		$iTotal = $this->HelpfulCounterYes + $this->HelpfulCounterNo;

		return $iTotal == 0 ? 'N/A' : intval(($this->HelpfulCounterYes / $iTotal) * 100) . ' %';
	}

}

class Page_Controller extends ContentController {

	private static $allowed_actions = array(
		'helpfulyes',
		'helpfulno'
	);

	public function Content() {
		return ShortCodeUtils::ParseShortCodes($this->Content);
	}

	public function Year() {
		return date('Y', strtotime(SS_Datetime::now()));
	}


	public function helpfulyes() {
		if(!Cookie::get('VotedYes'. $this->ID)) {
			DB::query("UPDATE Page SET HelpfulCounterYes = (HelpfulCounterYes + 1)");
			DB::query("UPDATE Page_Live SET HelpfulCounterYes = (HelpfulCounterYes + 1)");

			Cookie::set('VotedYes'. $this->ID);
		}

		return $this->redirectBack();
	}

	public function helpfulno() {
		if(!Cookie::get('VotedNo'. $this->ID)) {
			DB::query("UPDATE Page SET HelpfulCounterNo = (HelpfulCounterNo + 1)");
			DB::query("UPDATE Page_Live SET HelpfulCounterNo = (HelpfulCounterNo + 1)");

			Cookie::set('VotedNo'. $this->ID);
		}

		return $this->redirectBack();
	}

}