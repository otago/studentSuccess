<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 6:46 PM
 * To change this template use File | Settings | File Templates.
 */

class WasThisHelpful extends BaseElement {

	private static $title = "Was this helpful Element";
	
	private static $description = "Show a was this helpful YES and NO options on a page";

	private static $db = array(
		'Text'		=> 'Varchar(300)'
	);

	public function YesLink(){
		return $this->getController()->Link('yes');
	}


	public function NoLink(){
		return $this->getController()->Link('no');
	}

	public function Page(){
		return Director::get_current_page();
	}

}

class WasThisHelpful_Controller extends BaseElement_Controller {

	private static $allowed_actions = array(
		'yes',
		'no'
	);

	function yes(){
		$page = Director::get_current_page();
		if($page){
			$page->HelpfulCounterYes += 1;
			$page->write();
		}
		return $this->redirectBack();
	}

	function no(){
		$page = Director::get_current_page();
		if($page){
			$page->HelpfulCounterNo += 1;
			$page->write();
		}
		return $this->redirectBack();

	}

}