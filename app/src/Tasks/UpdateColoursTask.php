<?php
/**
 * Class UpdateMasonryTileSortOrders
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 */

namespace OP\Studentsuccess\Task;

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

            echo "$videoCom->title Updated from $linkCom->Color to $colour<br>";


            $videoCom->Color = $colour;
            $videoCom->write();
        }


    }
}
