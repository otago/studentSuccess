<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/16/15
 * Time: 2:09 PM
 * To change this template use File | Settings | File Templates.
 */

class GlossaryPage extends Page {

	private static $db = array(
		'GlossaryContent'	=> 'HTMLText'
	);

	private static $has_many = array(
		'GlossaryTypes'		=> 'GlossaryType'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->removeByName(array(
			'ElementArea'
		));


		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('GlossaryContent', 'Content'));
		$fields->addFieldToTab('Root.Glossary',
			FormUtils::MakeDragAndDropGridField('GlossaryTypes', 'GlossaryTypes', $this->GlossaryTypes(), 'SortOrder', 'RecordEditor')
		);

		return $fields;
	}

}

class GlossaryPage_Controller extends Page_Controller {


}