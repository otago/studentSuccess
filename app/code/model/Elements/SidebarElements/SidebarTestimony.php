<?php

class SidebarTestimony extends BaseElement {

	private static $title = "Sidebar quote";
	
	private static $description = "Sidebar quote";

	private static $db = array(
		'TestimonyContent'		=> 'Text',
		'TestimonyName'			=> 'Varchar(255)'
	);

} 