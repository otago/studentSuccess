<?php

namespace OP\studentsuccess;




use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Core\Config\Config;
use SilverStripe\SiteConfig\SiteConfig;
use DNADesign\Elemental\Models\BaseElement;



class CTAElement extends BaseElement {

	private static $title = "Call To Action";

	private static $description = "Call To Action";

	private static $db = array(
		'DisplayTitle'		=> 'Varchar',
		'Color'				=> 'Varchar',
		'Icon'				=> 'Varchar',
		'ButtonText'		=> 'Varchar',
		'CTAContent'		=> 'Text',
	);

	private static $has_one = array(
		'Image'				=> Image::class
	);
       /* public function __construct() 
        {   parent::__construct();  
            //debug::show($this);
            
//           // var_dump("sss");
        }*/
        public function MyImage()
        {
           // if($this->ID==92)
              //  Debug::show( $this);
            return "hello world";
            return $this->Image()->URL;
        }

	public function getCMSFields(){
            
           // if($this->ID==92)
             //   Debug::show( $this);
		$fields = parent::getCMSFields();

		$fields->replaceField('Color', DropdownField::create('Color')->setSource(array(
			'orange'		=> 'Orange (Default)',
			'black'			=> 'Black'
		)));
		
		$fields->replaceField('Icon', DropdownField::create('Icon')->setSource(Config::inst()->get(SiteConfig::class, 'Icons')));

		//$fields->dataFieldByName('CTAContent')->setTitle('Content');

		return $fields;
	}
} 