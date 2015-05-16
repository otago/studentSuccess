<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/14/15
 * Time: 5:49 PM
 * To change this template use File | Settings | File Templates.
 */

class ElementContentExtension extends DataExtension {


	function updateCMSFields(FieldList $fields){
		$contentField = $fields->dataFieldByName('HTML');
		if($contentField){
			$contentField->setRightTitle('<p>
				To add images with captions use the folloding short codes
				[Figure]<br>
				YOUR IMAGE
				[Caption]Caption Content[/Caption]
				[/Figure]
			</p>');
		}
	}

	function ProcessedHTML(){

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

		return $strRet;
	}

} 