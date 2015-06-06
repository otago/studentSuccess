<?php

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