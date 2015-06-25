<?php

class HomePage extends Page {

	private static $db = array(
		'HeroTitle'				=> 'Varchar(100)',
		'HeroContent'			=> 'Varchar(100)',
		'HeroLinkText'			=> 'Varchar(30)',
		'HeroLinkType'			=> 'Enum("None, Internal, External", "None")',
		'HeroInternalLinkID'	=> 'Int',
		'HeroExternalLink'		=> 'Varchar(300)',
		'HeroLinkTarget'		=> 'Enum("_self,_blank")'
	);

	private static $has_one = array(

	);


	function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->addFieldsToTab('Root.Hero', array(
			TextareaField::create('HeroTitle'),
			TextareaField::create('HeroContent'),
			HeaderField::create('HeroLinkTitle')->setTitle('Link settings')->setHeadingLevel(3),
			TextField::create('HeroLinkText'),
			DropdownField::create('HeroLinkType')->setSource(array(
				'None'		=> 'None',
				'Internal'	=> 'Internal',
				'External'	=> 'External'
			)),
			TreeDropdownField::create('HeroInternalLinkID')->setSourceObject('SiteTree'),
			TextField::create('HeroExternalLink'),
			DropdownField::create('HeroLinkTarget')->setSource(array(
				'_self' => '_self',
				'_blank' => '_blank'
			))

		));

		return $fields;
	}

	function HeroTitleHTML(){
		return nl2br($this->HeroTitle);
	}

	function HeroContentHTML(){
		return nl2br($this->HeroContent);
	}


	function HeroLink(){
		if($this->HeroLinkType == 'Internal' && $this->HeroInternalLinkID){
			$siteTree = SiteTree::get()->byID($this->HeroInternalLinkID);
			return $siteTree ? $siteTree->Link() : '';
		}elseif($this->HeroLinkType == 'External' && $this->HeroExternalLink){
			return $this->HeroExternalLink;
		}
	}

}

class HomePage_Controller extends Page_Controller {



}