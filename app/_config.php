<?php
/**
 * Created by Nivanka Fonseka (nivanka@silverstripers.com).
 * User: nivankafonseka
 * Date: 5/13/15
 * Time: 7:27 PM
 * To change this template use File | Settings | File Templates.
 */

global $project;
$project = 'opt';


global $database;
$database = (defined('SS_DATABASE_NAME')) ? SS_DATABASE_NAME : 'op3';

require_once("conf/ConfigureFromEnv.php");

FulltextSearchable::enable();

//

$arrStyles = array(
	'Large'					=> 'large',
	'Feature Link'			=> 'feature-link',
	'Feature Download'		=> 'feature-download',
	'Feature Email'			=> 'feature-mail',
	'Feature External Link'	=> 'feature-external-link'
);

$strItems = '';
foreach($arrStyles as $strKey => $strCSS){
	$strItems .= $strKey . '=' . $strCSS  . ',';
}
$strItems = substr($strItems, 0, -1);

HtmlEditorConfig::get('cms')->setOption('theme_advanced_styles', $strItems);

