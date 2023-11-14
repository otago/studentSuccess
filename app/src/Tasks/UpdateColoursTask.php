<?php
/**
 * Class UpdateMasonryTileSortOrders
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 */

namespace OP\Studentsuccess\Task;

use OP\Studentsuccess\CaseStudy;
use OP\Studentsuccess\CTAElement;
use OP\Studentsuccess\LinksComponent;
use OP\Studentsuccess\VideoComponent;
use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\Queries\SQLUpdate;


class UpdateColoursTask extends BuildTask
{

    /**
     * @param \SilverStripe\Control\HTTPRequest $request
     * @return void
     * @throws \Exception
     */
    public function run($request)
    {
        $colour = "";
        echo "<h2>LinksComponent</h2>";

        $this->updateDB("LinksComponent", "Color", "blue", "tpmaroon", true);
        $this->updateDB("LinksComponent", "Color", "red", "tpstone", true);
        $this->updateDB("LinksComponent", "Color", "green", "tpmediumgreen", true);

//
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        echo "<h2>VideoComponent</h2>";
        $this->updateDB("VideoComponent", "Color", "green", "tpmediumgreen", true);
        $this->updateDB("VideoComponent", "Color", "red", "tplightgreen", true);
        $this->updateDB("VideoComponent", "Color", "blue", "tpmaroon", true);
        $this->updateDB("VideoComponent", "Color", "yellow", "tpstone", true);


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        echo "<h2>CTAElement</h2>";
        $this->updateDB("CTAElement", "Color", "orange", "tpstone", true);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        echo "<h2>CaseStudy</h2>";
        $this->updateDB("CaseStudy", "Color", "green", "tpmediumgreen", true);
        $this->updateDB("CaseStudy", "Color", "red", "tpmaroon", true);
        $this->updateDB("CaseStudy", "Color", "blue", "tpstone", true);

        echo "<h2>CheckListBlock</h2>";
        $this->updateDB("CheckListBlock", "Color", "green", "tpmediumgreen",);
        $this->updateDB("CheckListBlock", "Color", "red", "tpmaroon",);
        $this->updateDB("CheckListBlock", "Color", "blue", "tpdark-green");
        $this->updateDB("CheckListBlock", "Color", "yellow", "tpstone");

        echo "<h2>WayFinder_Items</h2>";
        $this->updateDB("WayFinder_Items", "Background", "light-green", "tpmediumgreen");
        $this->updateDB("WayFinder_Items", "Background", "lighter-blue", "tpdark-green");
        $this->updateDB("WayFinder_Items", "Background", "getting-started", "tpstone");

        echo "<h2>Carousel</h2>";
        $this->updateDB("Carousel", "Background", "red", "tpmediumgreen", true);
        $this->updateDB("Carousel", "Background", "green", "tpmediumgreen", true);
        $this->updateDB("Carousel", "Background", "gray", "tpstone", true);
        $this->updateDB("Carousel", "Background", "blue", "tpstone", true);
        $this->updateDB("Carousel", "Background", "tpoffwhite", "tpstone", true);
    }

    private  function updateDB($table,$field,$beforeColour, $afterColour, $hasLive = false){

        $update = SQLUpdate::create($table)
            ->addWhere([$field => $beforeColour])
            ->assign($field,$afterColour);
        $update->execute();

        if ($hasLive == true) {
            $update = SQLUpdate::create($table."_Live")
                ->addWhere([$field => $beforeColour])
                ->assign($field,$afterColour);
            $update->execute();
        }
    }
}
