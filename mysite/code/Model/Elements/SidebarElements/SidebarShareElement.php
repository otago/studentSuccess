<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/15/15
 * Time: 8:13 PM
 * To change this template use File | Settings | File Templates.
 */

class SidebarShareElement extends BaseElement {


	private static $title = "Share Element";
	private static $description = "Share Element";

	function PageTitle(){
		$page = Director::get_current_page();
		return $page->Title;
	}

} 