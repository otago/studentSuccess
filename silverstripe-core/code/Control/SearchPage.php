<?php

class SearchPage extends Page_Controller {

    private static $allowed_actions = array(

            'SearchResults',
        'index'
	);
    
	function init(){

		parent::init();
	}

	function SearchText(){
		return isset($_GET['Search']) ? Convert::raw2xml($_GET['Search']) : '';
	}

        function index(){
            
		return $this->renderWith(array('SearchPage','Page'));
	}
	function SearchResults(){

		if(isset($_GET['Search'])){
			$form = new SearchForm($this, 'SearchForm');
			return $form->getResults();
		}
	}

} 