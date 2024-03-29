<?php

namespace OP\Studentsuccess;




use SilverStripe\Core\Convert;
use SilverStripe\CMS\Search\SearchForm;
use PageController;



class SearchPage extends PageController {

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
            
		return $this->renderWith(array(SearchPage::class,'Page'));
	}
	function SearchResults(){

		if(isset($_GET['Search'])){
			$form = new SearchForm($this, SearchForm::class);
			return $form->getResults();
		}
	}

} 