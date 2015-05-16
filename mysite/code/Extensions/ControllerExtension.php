<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 9:40 AM
 * To change this template use File | Settings | File Templates.
 */

class ControllerExtension extends Extension {

	function TopMenu(){
		return Page::get()->filter('ShowInTopMenu', 1);
	}

} 