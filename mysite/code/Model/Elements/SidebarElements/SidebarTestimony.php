<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/15/15
 * Time: 8:20 PM
 * To change this template use File | Settings | File Templates.
 */

class SidebarTestimony extends BaseElement {



	private static $title = "Sidebar Testimony Element";
	private static $description = "Sidebar Testimony Element";

	private static $db = array(
		'TestimonyContent'		=> 'Text',
		'TestimonyName'			=> 'Varchar(255)'
	);

} 