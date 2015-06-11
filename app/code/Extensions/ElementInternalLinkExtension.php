<?php

class ElementInternalLinkExtension extends DataExtension {
	
	private static $db = array(
		'OpenInModal' => 'Boolean'
	);

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldsToTab('Root.Main', new CheckboxField('OpenInModal'));
	}
}