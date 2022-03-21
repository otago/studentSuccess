<?php

namespace OP\Studentsuccess;


use SilverStripe\ORM\DataExtension;



class ElementFileExtension extends DataExtension {
	
	private static $db = array(
		'ForceDownload' => 'Boolean'
	);	
}