<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/14
 * Time: 12:01 PM
 * To change this template use File | Settings | File Templates.
 */

class Linkable extends DataExtension {

	private static $db = array(
		'LinkType'              => 'Enum("None, Internal, External", "None")',
		'InternalLinkID'        => 'Int',
		'ExternalLink'          => 'Varchar(300)',
		'Target'				=> 'Enum("_self,_blank")'
	);

	public function updateCMSFields(FieldList $fields){

		Requirements::javascript('silverstripe-core/javascript/Linkable.js');

		$fields->removeByName(array(
			'LinkType',
			'InternalLinkID',
			'ExternalLink',
			'Target'
		));

		$fields->addFieldsToTab('Root.Main', array(
			HeaderField::create('LinkTitle')->setTitle('Link settings')->setHeadingLevel(3),
			DropdownField::create('LinkType')->setSource(array(
				'None'		=> 'None',
				'Internal'	=> 'Internal',
				'External'	=> 'External'
			)),
			TreeDropdownField::create('InternalLinkID')->setSourceObject('SiteTree'),
			TextField::create('ExternalLink'),
			DropdownField::create('Target')->setSource(array(
				'_self' => 'Open in same window',
				'_blank' => 'Open in a new window'
			))
		));

	}

	function Link(){
		if($this->owner->LinkType == 'Internal' && $this->owner->InternalLinkID){
			$siteTree = SiteTree::get()->byID($this->owner->InternalLinkID);
			return $siteTree ? $siteTree->Link() : '';
		}elseif($this->owner->LinkType == 'External' && $this->owner->ExternalLink){
			return $this->owner->ExternalLink;
		}
	}


} 