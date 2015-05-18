<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 4/7/15
 * Time: 5:27 PM
 * To change this template use File | Settings | File Templates.
 */

class SearchPage extends Page_Controller {

	function init(){
		parent::init();
	}

	function SearchText(){
		return isset($_GET['Search']) ? Convert::raw2xml($_GET['Search']) : '';
	}


	function SearchResults(){
		if(isset($_GET['Search'])){
			$form = new SearchForm($this, 'SearchForm');
			return $form->getResults();
		}
	}

} 