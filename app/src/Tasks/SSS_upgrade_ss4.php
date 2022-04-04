<?php

namespace OP\Studentsuccess;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Models\ElementContent;
use DNADesign\ElementalList\Model\ElementList;
use OP\LoggingTrait;
use OP\OPMigrateFileTask;
use Page;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\BuildTask;
use SilverStripe\Dev\Debug;
use SilverStripe\ORM\DB;
use SilverStripe\ORM\Queries\SQLUpdate;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Widgets\Model\Widget;

/**
 *
 * @package cms
 * @subpackage assets
 */
class SSS_upgrade_ss4 extends BuildTask
{
    use LoggingTrait;

    protected $title = "SSSAssetsTask";
    protected $description = "SSSAssetsTask";

    /**
     *
     * @param \SilverStripe\Control\HTTPRequest $request
     */
    public function run($request)
    {
        echo "\n\n";
//        $this->doTheFiles($request);


        $this->dothewidgets();


        echo "\n\nDone! easy ;)";

    }


    private function dothewidgets()
    {
        //Accordion stuff has to go first
        $this->moveWidgetsToElement(['Accordion'] );
        $this->moveWidgetsToElement(['AccordionItem'] );

        $claases = [
            'CheckList',
            'Carousel',
            'CaseStudy',

            'ContactElement',

            'HearFromOthers',
            'WayFinder',
            'ElementLink',
            'InteractiveList',
            'LinksComponent',
            'MasonryContentsWithFilters',
            'SidebarImageElement',
            'SidebarTestimony',

            //Silverstripe
            'ElementContent',



        //************************************************************
            'CTAElement',

            'CarouselWithUpperLetter',
            'ElementTable',

            'MasonryContent',

            'MatrixElement',
            'ReferencesElement',
            'SidebarHelp',

            'SingleLevelCheckList',
            'SingleLevelList',


        ];
        $dieOn = "SingleLevelList";
        $this->moveWidgetsToElement($claases , $dieOn);

    }


    private function moveWidgetsToElement($claases  ,$dieOn = "")
    {
        $widgets = Widget::get()->filter(["ClassName" => $claases])->sort([
            'ParentID' => 'Desc',
            'ID' => 'ASC'
        ]);
        foreach ($widgets as $widget) {
            $count = "" . $widgets->count();


            if (in_array($widget->RecordClassName, $claases)) {

                switch ($widget->RecordClassName) {
                    case 'ElementContent':
                        $element = Injector::inst()->create(ElementContent::class);
                        $element->HTML = DB::query("SELECT HTML FROM ElementContent where id = $widget->ID")->value();
                        $element->ReadMoreContent = DB::query("SELECT ReadMoreContent FROM ElementContent where id = $widget->ID")->value();
                        break;
                    default:
                        $element = Injector::inst()->create("OP\\Studentsuccess\\" . $widget->RecordClassName);
                        break;
                }
            } else {
                $this->log("skipped: " . $widget->RecordClassName);
                continue;
            }

            switch ($widget->RecordClassName) {
                case 'SidebarImageElement':
                    $element->Caption = DB::query("SELECT Caption FROM ElementImage where id = $widget->ID")->value();
                    break;
                case 'AccordionItem':
                    $element->ListDescription = DB::query("SELECT el.ListDescription FROM ElementList el  WHERE el.ID = $widget->ID")->value();
                    break;
                case 'CaseStudy':
                    $element->CaseStudyContent = DB::query("SELECT CaseStudyContent FROM CaseStudy  WHERE ID = $widget->ID")->value();
                    $element->SummaryQuote = DB::query("SELECT Summary FROM CaseStudy  WHERE ID = $widget->ID")->value();
                    break;
                case 'ElementTable':
                    $element->HTML = DB::query("SELECT HTML FROM ElementContent where id = $widget->ID")->value();
                    break;
                case 'ReferencesElement':
                    $element->reflink = DB::query("SELECT link FROM ReferencesElement where id = $widget->ID")->value();
                    break;
                case 'CheckList':
                case 'SingleLevelCheckList':
                    $element->Intro = DB::query("SELECT Summary FROM CheckList where id = $widget->ID")->value();
                    break;

            }

            $element->Title = $widget->Title;
            $element->Sort = $widget->Sort;

            $element->ID = $widget->ID;

            $element->write();
            $pageid = [];

            //Post workd
//            switch ($widget->RecordClassName) {
//                case 'CheckList':
//                   $cl = CheckList::get_by_id($widget->ID);
//
//                    foreach ($cl->Items() as $clitems) {
//
//                        if ($clitems->Content == null) {
//                            $this->log("\t\t\t\t CheckList items: ".$clitems->ID);
////                            $clitems->Content = $element->Content = DB::query("SELECT Content FROM ListCollectionItem  WHERE ID = $clitems->ID")->value();
////                            $clitems->write();
//                           // die("ssss");
//                        }
//
//                    }
//                    // $element->Content = DB::query("SELECT Content FROM ListCollectionItem  WHERE ID = $widget->ID")->value();
//
//                    break;
//            }


            $update1 = SQLUpdate::create('"Element"')->addWhere(['ID' => $element->ID]);
            $update1->assign('"Classname"', $element->ClassName);
            $update1->execute();

            $this->log("\t\t\t $widget->RecordClassName - $widget->Title ID:  $widget->ID::$element->ID");
            if ($widget->ParentID > 0) {

                $page = Page::get()->filter(["ElementAreaID" => $widget->ParentID])->first();
                if ($page != null) {
                    $this->log("Page: " . $page->ID . " " . $page->Title . " Widparent: " . $widget->ParentID);
                    $area = $page->ElementalArea;
                    $area->Elements()->add($element);
                    $page->publishRecursive();
                    $pageid[] = $page->ID;
                } else {
                    $this->log(" NO Page:  widget $widget->ID $widget->Title parentid:$widget->ParentID");
                }
            } else {
                $elelemtn = BaseElement::get_by_id($element->ID);

                $Elist = DB::query("SELECT el.ElementsID FROM baseelement be join ElementList el on be.ListID=el.id where be.id = $widget->ID")->value();


                $this->log("widget" . $widget->ID);
                if ($Elist != null && $Elist > 0 && $elelemtn->ParentID == 0) {
                    DB::query("
                                 UPDATE Element
                                    SET
                                    ParentID = (SELECT el.ElementsID FROM baseelement be join ElementList el on be.ListID=el.id where be.id = $widget->ID)
                                    WHERE `ID` = $widget->ID;
                            ");
                    $this->log("\t\t\t  UPDATE Element");
                }

            }

            if (
               // $widget->ID == 1595
                $widget->RecordClassName == $dieOn
               // and $widget->ID != 300
            ) {
                die("$dieOn .... 7777777777");

            }else {
                $this->log("\t\t\t  Delete Element $widget->ID");
                $widget->delete();
            }



        }
    }

    private function doTheFiles($request)
    {
        foreach (SiteConfig::get() as $sc) {
            $sc->FeedBackLiteOn = false;
            $sc->write();
        }
        $MigrateFileTask = OPMigrateFileTask::create();
        $MigrateFileTask->run($request);
    }

}
