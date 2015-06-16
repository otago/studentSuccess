<?php

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

Config::inst()->remove('LandingPage', 'allowed_elements');

Config::inst()->update('LandingPage', 'allowed_elements', array(
	'MasonryContent'
));

Config::inst()->remove('LandingSearchPage', 'allowed_elements');

Config::inst()->update('LandingSearchPage', 'allowed_elements', array(
	'MasonryContentsWithFilters'
));

Config::inst()->remove('HomePage', 'allowed_elements');

Config::inst()->update('HomePage', 'allowed_elements', array(
	'WayFinder',
	'HearFromOthers'
));
