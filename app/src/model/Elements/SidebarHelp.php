<?php

namespace OP\studentsuccess;


use OP\studentsuccess\Contactable;
use DNADesign\Elemental\Models\BaseElement;



class SidebarHelp extends BaseElement {
	
	private static $title = "Sidebar Help";
	
	private static $description = "Sidebar Help";

	private static $extensions = array(
		Contactable::class
	);

}