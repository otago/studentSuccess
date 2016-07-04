<?php

class OTPConfigs extends DataExtension {

	private static $db = array(
		'TelephoneInternational'		=> 'Varchar',
		'TelephoneNewZealand'			=> 'Varchar',
		'ContactEmail'					=> 'Varchar',
		'AddressCol1'					=> 'Text',
		'AddressCol2'					=> 'Text',
		'AddressCol3'					=> 'Text',

		'ContactBoxTitle'				=> 'Varchar(70)',
		'ContactBoxContent'				=> 'Varchar(100)',
		'ContactBoxPhone'				=> 'Varchar',
		'ContactBoxEmail'				=> 'Varchar',
            
            
            
		'CreativeCommonsLicence' => 'HTMLText',
		'FeedBackLiteOn'	=> 'Boolean',
		'FeedBackLite'	=> 'text'
            
	);
        
        private static $has_one = array(
		 'CreativeCommonsLicenceImage'                       => 'Image',
	);

	public function updateCMSFields(FieldList $fields){

		$fields->addFieldsToTab('Root.Contacts', array(
			HeaderField::create('ContactBox')->setTitle('Contact element on related info'),
			TextField::create('ContactBoxTitle')->setTitle('Title'),
			TextareaField::create('ContactBoxContent')->setTitle('Content'),
			TextField::create('ContactBoxPhone')->setTitle('Phone'),
			TextField::create('ContactBoxEmail')->setTitle('Email'),
		));


                $uploadField = UploadField::create('CreativeCommonsLicenceImage')
                ->setAllowedFileCategories('image')
                ->setAllowedMaxFileNumber(1);
                  $caption = HTMLEditorField::create('CreativeCommonsLicence');
                
		$fields->addFieldsToTab('Root.Footer.Top', array(
			FormUtils::MakeDragAndDropGridField('LinkBlocks', 'Link Blocks', FooterLinkBlock::get(), 'SortOrder'),
                    
                    $uploadField,

                       $caption
                    
		));
                
           $fields->addFieldToTab("Root.Main", new CheckboxField('FeedBackLiteOn', 'FeedBackLiteOn')); 
		   $fields->addFieldToTab("Root.Main", new TextareaField('FeedBackLite', 'FeedBackLite')); 

		$fields->addFieldsToTab('Root.Footer.Bottom', array(
			TextField::create('TelephoneInternational'),
			TextField::create('TelephoneNewZealand'),
			TextField::create('ContactEmail'),
			TextareaField::create('AddressCol1'),
			TextareaField::create('AddressCol2'),
			TextareaField::create('AddressCol3')
		));
	}


	function AddressCol1HTML(){
		return nl2br($this->owner->AddressCol1);
	}

	function AddressCol2HTML(){
		return nl2br($this->owner->AddressCol2);
	}

	function AddressCol3HTML(){
		return nl2br($this->owner->AddressCol3);
	}


	/**
	 * @return ArrayList
	 */
	function GetFooterLinks(){
		$iLinks = FooterLink::get()->count();
		$iPerCol = floor($iLinks / 3);
		$alRet = new ArrayList();

		$iCounter = 0;
		$col = null;
		foreach(FooterLinkBlock::get() as $block){

			if((!$col || $iCounter >= $iPerCol) && $alRet->count() != 3){
				$col = new ArrayData(array(
					'Blocks'		=> new ArrayList()
				));
				$alRet->push($col);
				$iCounter = 0;
			}


			$col->Blocks->push($block);
			$iCounter += $block->Links()->count();
		}

		return $alRet;
	}

} 