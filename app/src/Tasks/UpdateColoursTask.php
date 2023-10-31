<?php
/**
 * Class UpdateMasonryTileSortOrders
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 */

namespace OP\Studentsuccess\Task;

use OP\Studentsuccess\LinksComponent;
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
            echo "$linkCom->title Updated from $linkCom->Color to $colour<br>";

            $linkCom->Color = $colour;
            $linkCom->write();


        }

    }
}
