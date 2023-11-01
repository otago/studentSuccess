<?php
/**
 * Class UpdateMasonryTileSortOrders
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 */

namespace OP\Studentsuccess\Task;

use OP\Studentsuccess\CaseStudy;
use OP\Studentsuccess\LinksComponent;
use OP\Studentsuccess\VideoComponent;
use SilverStripe\Dev\BuildTask;


class UpdateColoursTask extends BuildTask
{

    /**
     * @param \SilverStripe\Control\HTTPRequest $request
     * @return void
     * @throws \Exception
     */
    public function run($request)
    {

        echo "<h2>LinksComponent</h2>";
        foreach (LinksComponent::get() as $linkCom) {
            switch (strtolower($linkCom->Color)) {
                case "blue":
                    $colour = "tpmaroon";
                    break;
                case "red":
                    $colour = "tpstone";
                    break;
                case "green":
                    $colour = "tpmediumgreen";
                    break;
            }

            echo "$linkCom->title Updated from $linkCom->Color to $colour<br>";

            $linkCom->Color = $colour;
            $linkCom->write();
        }

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

        echo "<h2>VideoComponent</h2>";
        foreach (VideoComponent::get() as $videoCom) {
            switch (strtolower($videoCom->Color)) {
                case "green":
                    $colour = "tpmediumgreen";
                    break;
                case "red":
                    $colour = "tplightgreen";
                    break;
                case "blue":
                    $colour = "tpmaroon";
                    break;
                case "yellow":
                    $colour = "tpstone";
                    break;
            }

            echo "$videoCom->title Updated from $videoCom->Color to $colour<br>";


            $videoCom->Color = $colour;
            $videoCom->write();
        }

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        echo "<h2>CTAElement</h2>";
        foreach (CTAElement::get() as $CTA) {
            switch (strtolower($CTA->Color)) {
                case "orange":
                    $colour = "tpstone";
                    break;
                case "gdddd":
                    $colour = "tplightgreen";
                    break;
            }

            echo "$CTA->title Updated from $CTA->Color to $colour<br>";


            $CTA->Color = $colour;
            $CTA->write();
        }

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
        echo "<h2>CaseStudy</h2>";
        foreach (CaseStudy::get() as $CaseStudy) {
            switch (strtolower($CaseStudy->Color)) {
                case "green":
                    $colour = "tpmediumgreen";
                    break;
                case "red":
                    $colour = "tpmaroon";
                    break;
                case "blue":
                    $colour = "tpstone";
                    break;
            }

            echo "$CaseStudy->title Updated from $CaseStudy->Color to $colour<br>";


            $CaseStudy->Color = $colour;
            $CaseStudy->write();
        }


    }
}
