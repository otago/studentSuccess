<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 9:16 AM
 * To change this template use File | Settings | File Templates.
 */

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
			LiteralField::create('WasThisHelpful', "<h4>Was this help ful ? {$this->owner->HelpfulCounterYes} - YES | {$this->owner->HelpfulCounterNo} - NO</h4>")
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

		

		$this->AddRelatedTopicsFields($fields);
	}

	function AddRelatedTopicsFields(FieldList $fields){

		$fields->removeByName('Contacts');

		$fields->addFieldsToTab('Root.RelatedTopics', array(
			TextField::create('RelatedTopicsTitle'),
			CheckboxField::create('ShowRelatedTopicsContacts')->setTitle('Show contacts'),
			FormUtils::MakeDragAndDropGridField('RelatedPages', 'RelatedPages', $this->owner->RelatedPages(), 'SortOrder'),
			FormUtils::MakeDragAndDropGridField('RelatedBoxes', 'RelatedBoxes', $this->owner->RelatedBoxes(), 'SortOrder'),
			HeaderField::create('ContactBox')->setTitle('Contact element details, if you dont wish to override these from the global settings, leave blank')->setHeadingLevel(4),
			TextField::create('ContactBoxTitle')->setTitle('Title'),
			TextareaField::create('ContactBoxContent')->setTitle('Content'),
			TextField::create('ContactBoxPhone')->setTitle('Phone'),
			TextField::create('ContactBoxEmail')->setTitle('Email'),
		));

	}	


	public function onBeforeWrite() {

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


	function HelpfulCounterPercentage(){
		$iTotal = $this->owner->HelpfulCounterYes + $this->owner->HelpfulCounterNo;
		return $iTotal == 0 ? 'N/A' : intval(($this->owner->HelpfulCounterYes / $iTotal) * 100) . ' %';
	}

} 