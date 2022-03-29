<?php

namespace OP\Studentsuccess;

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

        $claases = [
            'Accordion',
//            'Carousel',
//            'CaseStudy',
//            'CheckList',
            'ContactElement',
//            'CTAElement',
            'HearFromOthers',
            'WayFinder',
            'ElementLink',


            'AccordionItem',
//            'CarouselWithUpperLetter',
//            'ElementTable',
//            'InteractiveList',
//            'LinksComponent',
//            'MasonryContent',
            'MasonryContentsWithFilters',
//            'MatrixElement',
//            'ReferencesElement',
//            'SidebarHelp',
//            'SidebarImageElement',
//            'SidebarTestimony',
//            'SingleLevelCheckList',
//            'SingleLevelList',
//            'VideoComponent'
        ];

        echo $this->config()->get('target_element');

        $widgets = Widget::get()->filter(["ClassName" => $claases])->sort(['ParentID' => 'Desc']);
        foreach ($widgets as $widget) {
            $count = "" . $widgets->count();
//        if ($widget->ID != 4386) {
//            continue;
//        }

            if (in_array($widget->RecordClassName, $claases)) {
                $element = Injector::inst()->create("OP\\Studentsuccess\\" . $widget->RecordClassName);
            } else {
                $this->log("skipped: " . $widget->RecordClassName);
                continue;
            }


            $element->Title = $widget->Title;
            $element->Sort = $widget->Sort;

            $element->ID = $widget->ID;

            $element->write();

            switch ($widget->RecordClassName) {
                case 'AccordionItem':
                    DB::query("
                             UPDATE AccordionItem
                                SET
                                ListDescription = (SELECT el.ListDescription FROM ElementList el  WHERE el.ID = AccordionItem.ID)
                                WHERE `ID` = $widget->ID;
                        ");
                    break;
//                    default:
//                        echo "skipped: ". $widget->RecordClassName ."\n";
//                        continue 2;
            }


            $update1 = SQLUpdate::create('"Element"')->addWhere(['ID' => $element->ID]);
            $update1->assign('"Classname"', $element->ClassName);
            $update1->execute();

            if ($widget->ParentID > 0) {

                $page = Page::get()->filter(["ElementAreaID" => $widget->ParentID])->first();
                if ($page != null) {
                    $this->log("Page: " . $page->ID . " " . $page->Title . " Widparent: " . $widget->ParentID);
                    $area = $page->ElementalArea;
                    $area->Elements()->add($element);
                    $page->publishRecursive();
                } else {
                    $this->log(" NO Page:  widget $widget->ID $widget->Title parentid:$widget->ParentID");
                }
            } else {
                $Elist = DB::query("SELECT el.ElementsID FROM baseelement be join ElementList el on be.ListID=el.id where be.id = $widget->ID")->value();


                $this->log("widget" . $widget->ID);
                if ($Elist != null && $Elist > 0) {
                    DB::query("
                                 UPDATE Element
                                    SET
                                    ParentID = (SELECT el.ElementsID FROM baseelement be join ElementList el on be.ListID=el.id where be.id = $widget->ID)
                                    WHERE `ID` = $widget->ID;
                            ");
                    $this->log("\t\t\t  UPDATE Element");
                }

            }

            $this->log("\t\t\t $widget->RecordClassName - $widget->Title ID:  $widget->ID::$element->ID");


            //                        $update1 = SQLUpdate::create('"WayFinder_Items"')->addWhere(['WayFinderID' => $element->ID]);
            //                        $update1->assign('"WayFinderID"', $element->ID * -1);
            //                        $update1->execute();


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
