<?php

class Linkable extends DataExtension {

	private static $db = array(
		'LinkType'              => 'Enum("None, Internal, External, File", "None")',
		'InternalLinkID'        => 'Int',
		'InternalFileID'        => 'Int',
		'ExternalLink'          => 'Varchar(300)',
		'Target'				=> 'Enum("_self,_blank,_modal")',
		'ForceDownload' 		=> 'Boolean'
	);

	public function updateCMSFields(FieldList $fields){

		Requirements::javascript('silverstripe-core/javascript/Linkable.js');

		$fields->removeByName(array(
			'LinkType',
			'InternalLinkID',
			'InternalFileID',
			'ExternalLink',
			'Target',
			'ForceDownload'
		));

		$fields->addFieldsToTab('Root.Main', array(
			HeaderField::create('LinkTitle')->setTitle('Link settings')->setHeadingLevel(3),
			DropdownField::create('LinkType')->setSource(array(
				'None'		=> 'None',
				'Internal'	=> 'Internal',
				'External'	=> 'External',
				'File' => 'File'
			)),
			TreeDropdownField::create('InternalLinkID')->setSourceObject('SiteTree'),
			TreeDropdownField::create('InternalFileID')->setSourceObject('File'),
			TextField::create('ExternalLink'),
			DropdownField::create('Target')->setSource(array(
				'_self' => 'Open in same window',
				'_blank' => 'Open in a new window',
				'_modal' => 'Modal Window'
			)),
			CheckboxField::create('ForceDownload')
		));

	}

	public function Link() {
		if($this->owner->LinkType == 'Internal' && $this->owner->InternalLinkID) {
			$siteTree = SiteTree::get()->byID($this->owner->InternalLinkID);

			return $siteTree ? $siteTree->Link() : '';
		} else if($this->owner->LinkType == 'External' && $this->owner->ExternalLink) {
			return $this->owner->ExternalLink;
		} else if($this->owner->LinkType == 'File' && $this->owner->InternalFileID) {
			$file = File::get()->byID($this->owner->InternalFileID);

			return $file ? $file->Link() : '';
		}
	}

	public function OpenInModal() {
		return ($this->owner->Target == "_modal");
	}


} 