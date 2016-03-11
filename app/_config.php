<?php

global $project;
$project = 'opt';


global $database;
$database = (defined('SS_DATABASE_NAME')) ? SS_DATABASE_NAME : 'op3';
define('OP_CWP_IP_BYPASS_BASICAUTH', '202.49.0.2,10.50.1.180,127.0.0.1,10.111.0.10,127.0.0.1,10.50.1.184,10.50.1.188,10.110.4.32');
require_once("conf/ConfigureFromEnv.php");

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

Config::inst()->remove('AccordionPage', 'allowed_elements');

Config::inst()->update('AccordionPage', 'allowed_elements', array(
	'Accordion'
));

Config::inst()->remove('FilterableChecklist', 'allowed_elements');
