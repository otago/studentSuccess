<?php

use OP\Studentsuccess\ElementFile;
use OP\Studentsuccess\ElementImage;
use OP\Studentsuccess\ElementLink;
use SilverStripe\i18n\i18n;
use SilverStripe\Core\Config\Config;
use OP\Studentsuccess\MasonryContent;
use OP\Studentsuccess\MasonryContentsWithFilters;
use OP\Studentsuccess\HomePage;
use OP\Studentsuccess\WayFinder;
use OP\Studentsuccess\HearFromOthers;
use OP\Studentsuccess\AccordionItem;
use OP\Studentsuccess\SidebarImageElement;
use OP\Studentsuccess\SidebarHelp;
use OP\Studentsuccess\CTAElement;
use OP\Studentsuccess\ContactElement;
use OP\Studentsuccess\Carousel;
use OP\Studentsuccess\CarouselWithUpperLetter;
use OP\Studentsuccess\CaseStudy;
use OP\Studentsuccess\CheckList;
use DNADesign\Elemental\Models\ElementContent;
use OP\Studentsuccess\InteractiveList;
use OP\Studentsuccess\ReferencesElement;
use OP\Studentsuccess\SingleLevelCheckList;
use OP\Studentsuccess\SingleLevelList;
use OP\Studentsuccess\VideoComponent;
use OP\Studentsuccess\LinksComponent;
use OP\Studentsuccess\MatrixElement;
use OP\Studentsuccess\SidebarTestimony;
use OP\Studentsuccess\TabbedCheckList;
use SilverStripe\ORM\Search\FulltextSearchable;


global $project;
$project = 'opt';

i18n::set_locale('en_NZ');
ini_set('date.timezone', 'Pacific/Auckland');
FulltextSearchable::enable();

//SS_Log::add_writer(new SS_LogEmailWriter('alastairn@op.ac.nz'), SS_Log::WARN, '<=');
$arrStyles = [
    'Large' => 'large',
    'Feature Link' => 'feature-link',
    'Feature Download' => 'feature-download',
    'Feature Email' => 'feature-mail',
    'Feature External Link' => 'feature-external-link'
];

$strItems = '';
foreach ($arrStyles as $strKey => $strCSS) {
    $strItems .= $strKey . '=' . $strCSS . ',';
}
$strItems = substr($strItems, 0, -1);

Config::inst()->remove(HomePage::class, 'allowed_elements');

Config::inst()->update(HomePage::class, 'allowed_elements', [
    WayFinder::class,
    HearFromOthers::class
]);


$classes = [
    ElementFile::class,
    ElementLink::class,
    ElementImage::class,
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
];


Config::inst()->update(AccordionItem::class, 'allowed_elements', $classes);

Config::inst()->update('Page', 'allowed_elements', [
    MasonryContent::class,
    MasonryContentsWithFilters::class,
    TabbedCheckList::class
]);
