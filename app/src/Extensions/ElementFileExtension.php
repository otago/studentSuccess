<?php

namespace OP\studentsuccess;


use SilverStripe\ORM\DataExtension;



class ElementFileExtension extends DataExtension {
	
	private static $db = array(
		'ForceDownload' => 'Boolean'
	);	
}