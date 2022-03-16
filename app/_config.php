<?php
use SilverStripe\i18n\i18n;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Config\Config;
use OP\studentsuccess\LandingPage;
use OP\studentsuccess\MasonryContent;
use OP\studentsuccess\LandingSearchPage;
use OP\studentsuccess\MasonryContentsWithFilters;
use OP\studentsuccess\HomePage;
use OP\studentsuccess\WayFinder;
use OP\studentsuccess\HearFromOthers;
use OP\studentsuccess\AccordionPage;
use OP\studentsuccess\Accordion;
use OP\studentsuccess\AccordionItem;
use OP\studentsuccess\ElementTable;
use OP\studentsuccess\SidebarImageElement;
use OP\studentsuccess\SidebarHelp;
use OP\studentsuccess\CTAElement;
use OP\studentsuccess\ContactElement;
use OP\studentsuccess\Carousel;
use OP\studentsuccess\CarouselWithUpperLetter;
use OP\studentsuccess\CaseStudy;
use OP\studentsuccess\CheckList;
use DNADesign\Elemental\Models\ElementContent;
use OP\studentsuccess\InteractiveList;
use OP\studentsuccess\ReferencesElement;
use OP\studentsuccess\SingleLevelCheckList;
use OP\studentsuccess\SingleLevelList;
use OP\studentsuccess\VideoComponent;
use OP\studentsuccess\LinksComponent;
use OP\studentsuccess\MatrixElement;
use OP\studentsuccess\SidebarTestimony;
use OP\studentsuccess\TabbedCheckList;


global $project;
$project = 'opt';


global $database;
$database = (defined('SS_DATABASE_NAME')) ? SS_DATABASE_NAME : 'op3';

require_once("conf/ConfigureFromEnv.php");
i18n::set_locale('en_NZ');
ini_set('date.timezone', 'Pacific/Auckland');

define('OP_CWP_IP_BYPASS_BASICAUTH', '202.49.0.2,10.50.1.180,127.0.0.1,10.111.0.10,127.0.0.1,10.50.1.184,10.50.1.188,10.110.4.32,115.188.251.154');
// we extend this in OPCwpControllerExtension.php
Controller::remove_extension('CwpControllerExtension');
//SS_Log::add_writer(new SS_LogEmailWriter('alastairn@op.ac.nz'), SS_Log::WARN, '<=');
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

Config::inst()->remove(LandingPage::class, 'allowed_elements');

Config::inst()->update(LandingPage::class, 'allowed_elements', array(
	MasonryContent::class
));

Config::inst()->remove(LandingSearchPage::class, 'allowed_elements');

Config::inst()->update(LandingSearchPage::class, 'allowed_elements', array(
	MasonryContentsWithFilters::class
));

Config::inst()->remove(HomePage::class, 'allowed_elements');

Config::inst()->update(HomePage::class, 'allowed_elements', array(
	WayFinder::class,
	HearFromOthers::class
));

Config::inst()->remove(AccordionPage::class, 'allowed_elements');

Config::inst()->update(AccordionPage::class, 'allowed_elements', array(
	Accordion::class
));

Config::inst()->remove('FilterableChecklist', 'allowed_elements');

Config::inst()->remove(AccordionItem::class, 'allowed_elements');

$classes=array(
ElementTable::class,
'ElementFile',
'ElementLink',
'ElementImage',
SidebarImageElement::class,
SidebarHelp::class,
CTAElement::class,
ContactElement::class,	
Carousel::class,
CarouselWithUpperLetter::class,
CaseStudy::class,
CheckList::class,
ElementContent::class,
InteractiveList::class,
	ReferencesElement::class,
SingleLevelCheckList::class,
SingleLevelList::class,
HearFromOthers::class,
VideoComponent::class,
LinksComponent::class,
MatrixElement::class,
SidebarTestimony::class,
TabbedCheckList::class 
);
// foreach ($classes as $class) {
//    $list[$class] = singleton($class)->i18n_singular_name();
//}
Config::inst()->update(AccordionItem::class, 'allowed_elements', $classes);

Config::inst()->update('Page', 'allowed_elements', array(
MasonryContent::class,
    MasonryContentsWithFilters::class,
    TabbedCheckList::class 
));