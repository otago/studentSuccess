<?php

class ElementContentExtension extends DataExtension {

	private static $db = array(
		'ReadMoreTitle' => 'Varchar(200)',
		'ReadMoreContent' => 'HTMLText'
	);
        
        private static $many_many = array(
		'Reference'=> 'ReferencesElement'
	);

	private static $casting = array(
		'ProcessedHTML' => 'HTMLText'
	);

	function updateCMSFields(FieldList $fields){
		$contentField = $fields->dataFieldByName('HTML');
                
                $Reference = $fields->dataFieldByName('Reference');
                $fields->addFieldToTab('Root.Main', $Reference);
                

		if($contentField) {
			$contentField->setRightTitle('<p>
				To add images with captions use the folloding short codes
				[Figure]<br>
				YOUR IMAGE
				[Caption]Caption Content[/Caption]
				[/Figure]
			</p>');
		}
	}

	function ProcessedHTML() {
		$strRet = $this->owner->HTML;

		// update tables
		$strRet = str_replace('<table', '<div class="table"><table', $strRet);
		$strRet = str_replace('</table>', '</table></div>', $strRet);

		while($arrParts = StringUtils::GetBeforeBetweenAndAfter($strRet, '[Figure]', '[/Figure]')){
			$strRet = $arrParts['Before'] . '<figure>';

			$strBetween = $arrParts['Between'];

			$strBetween = str_replace('<p>', '', $strBetween);
			$strBetween = str_replace('</p>', '', $strBetween);


			$strBetween = str_replace('[Caption]', '<figcaption>', $strBetween);
			$strBetween = str_replace('[/Caption]', '</figcaption>', $strBetween);

			if($arrImageParts = StringUtils::GetBeforeBetweenAndAfter($strBetween, '<img', '>')){
				$strBetween = $arrImageParts['Before'] . '<picture><img' . $arrImageParts['Between'] . '></picture>' . $arrImageParts['After'];
			}

			$strRet .= $strBetween;

			$strRet .= '</figure>' . $arrParts['After'];
		}

		return ShortcodeParser::get_active()->parse($strRet);
	}
}
