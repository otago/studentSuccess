<?php

namespace OP\Studentsuccess;


use OP\Studentsuccess\ReferencesElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\View\Parsers\ShortcodeParser;
use SilverStripe\ORM\DataExtension;
use OP\Studentsuccess\StringUtils;


class ElementContentExtension extends DataExtension
{

    private static $db = [
        'ReadMoreTitle' => 'Varchar(200)',
        'ReadMoreContent' => 'HTMLText'
    ];

    private static $many_many = [
        'Reference' => ReferencesElement::class
    ];

    private static $casting = [
        'ProcessedHTML' => 'HTMLText'
    ];

    function updateCMSFields(FieldList $fields)
    {
        $contentField = $fields->dataFieldByName('HTML');
        // debug::dump($this);
        if ($this->owner->ID) {

            $Reference = $fields->dataFieldByName('Reference');
            $fields->addFieldToTab('Root.Main', $Reference);
        }

        if ($contentField) {
            $contentField->setRightTitle('<p>
				To add images with captions use the folloding short codes
				[Figure]<br>
				YOUR IMAGE
				[Caption]Caption Content[/Caption]
				[/Figure]
			</p>');
        }

    }

    function onAfterWrite()
    {
        parent::onAfterWrite();
        foreach ($this->owner->Reference() as $ref) {
            $ref->publish('Stage', 'Live');
            //echo $ref->Title;
        }
    }

    function ProcessedHTML()
    {
        $strRet = $this->owner->HTML;

        // update tables
        $strRet = str_replace('<table', '<div class="table"><table', $strRet);
        $strRet = str_replace('</table>', '</table></div>', $strRet);

        while ($arrParts = StringUtils::GetBeforeBetweenAndAfter($strRet, '[Figure]', '[/Figure]')) {
            $strRet = $arrParts['Before'] . '<figure>';

            $strBetween = $arrParts['Between'];

            $strBetween = str_replace('<p>', '', $strBetween);
            $strBetween = str_replace('</p>', '', $strBetween);


            $strBetween = str_replace('[Caption]', '<figcaption>', $strBetween);
            $strBetween = str_replace('[/Caption]', '</figcaption>', $strBetween);

            if ($arrImageParts = StringUtils::GetBeforeBetweenAndAfter($strBetween, '<img', '>')) {
                $strBetween = $arrImageParts['Before'] . '<picture><img' . $arrImageParts['Between'] . '></picture>' . $arrImageParts['After'];
            }

            $strRet .= $strBetween;

            $strRet .= '</figure>' . $arrParts['After'];
        }

        return ShortcodeParser::get_active()->parse($strRet);
    }
}
