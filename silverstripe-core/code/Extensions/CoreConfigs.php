<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 4/6/15
 * Time: 9:36 AM
 * To change this template use File | Settings | File Templates.
 */

class CoreConfigs extends DataExtension {

	private static $db = array(
		'DefaultWidth'			=> 'Int',
		'DefaultHeight'			=> 'Int'
	);

	private static $has_one = array(
		'ImagePlaceHolder'		=> 'Image'
	);

	public function updateCMSFields(FieldList $fields){

		$fields->addFieldsToTab('Root.Settings.Images', array(
			NumericField::create('DefaultWidth'),
			NumericField::create('DefaultHeight'),
			UploadField::create('ImagePlaceHolder')
		));

	}


} 