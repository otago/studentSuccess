<?php
namespace OP\Studentsuccess;
use DNADesign\Elemental\Models\ElementContent;
use OP\OPMigrateFileTask;
use SilverStripe\CMS\Model\SiteTree;
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
class SSS_upgrade_ss4 extends BuildTask {

	protected $title = "SSSAssetsTask";
	protected $description = "SSSAssetsTask";

	/**
	 *
	 * @param \SilverStripe\Control\HTTPRequest $request
	 */
	public function run($request) {
        echo "\n\n";
//        $this->doTheFiles($request);
        $this->dothewidgets();




		echo "\n\nDone! easy ;)";

	}


    private function dothewidgets() {

        $claases = [
//           'Accordion',
//            'Carousel',
//            'CaseStudy',
//            'CheckList',
//            'ContactElement',
//            'CTAElement',
            'HearFromOthers',
            'WayFinder',


//            'AccordionItem',
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


        foreach (Widget::get()->filter(["ClassName"=>$claases])as $widget) {

            if ($widget->ParentID > 0) {


                switch ($widget->RecordClassName) {
                    case 'WayFinder':
                        $element = WayFinder::create();
                        break;
                    case 'HearFromOthers':
                        $element = HearFromOthers::create();
                        break;
                    case 'MasonryContentsWithFilters':
                        $element = MasonryContentsWithFilters::create();
                        break;
                    default:
                        echo "skipped: ". $widget->RecordClassName ."\n";
                        continue 2;
                }
                echo $widget->RecordClassName."\n";
                $page = SiteTree::get_by_id($widget->ParentID);
                echo $page->Title;//
                $area = $page->ElementalArea;

                $element->Title =  $widget->Title;
                $element->Sort =  $widget->Sort;
                $element->ID =  $widget->ID;

                $element->write();
                $update1 = SQLUpdate::create('"Element"')->addWhere(['ID' => $element->ID]);
                $update1->assign('"Classname"', $element->ClassName);
                $update1->execute();

                $area->Elements()->add($element);


    //                        $update1 = SQLUpdate::create('"WayFinder_Items"')->addWhere(['WayFinderID' => $element->ID]);
    //                        $update1->assign('"WayFinderID"', $element->ID * -1);
    //                        $update1->execute();
    //
    //
    //                        $update = SQLUpdate::create('"WayFinder_Items"')->addWhere(['WayFinderID' => $widget->ID]);
    //                        $update->assign('"WayFinderID"', $element->ID);
    //                        $update->execute();
    //
    //                        $update1 = SQLUpdate::create('"WayFinder_Filters"')->addWhere(['WayFinderID' => $element->ID]);
    //                        $update1->assign('"WayFinderID"', $element->ID * -1);
    //                        $update1->execute();
    //
    //
    //                        $update = SQLUpdate::create('"WayFinder_Filters"')->addWhere(['WayFinderID' => $widget->ID]);
    //                        $update->assign('"WayFinderID"', $element->ID);
    //                        $update->execute();

                $widget->delete();
                $page->publishRecursive();

            } else {
                echo "skipped ID: ". $widget->ID;
            }
            //  var_dump($widget);
        }
    }

    private function doTheFiles($request) {
        foreach (SiteConfig::get() as $sc) {
            $sc->FeedBackLiteOn =false;
            $sc->write();
        }
        $MigrateFileTask = OPMigrateFileTask::create();
        $MigrateFileTask->run($request);
    }

}
