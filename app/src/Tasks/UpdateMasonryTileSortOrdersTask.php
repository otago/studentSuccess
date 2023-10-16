<?php
/**
 * Class UpdateMasonryTileSortOrders
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 */

namespace OP\Studentsuccess\Task;

use OP\Studentsuccess\MasonryTile;
use SilverStripe\Dev\BuildTask;


class UpdateMasonryTileSortOrdersTask extends BuildTask
{

    /**
     * @param \SilverStripe\Control\HTTPRequest $request
     * @return void
     * @throws \Exception
     */
    public function run($request)
    {

        $mTiles = MasonryTile::get()->sort(['MasonryContentID' => 'ASC', 'SortOrder' => 'ASC']);

        $counter = 0;
        $MasonryContentID = -55;

        foreach ($mTiles as $tile) {
            if ($tile->MasonryContentID != $MasonryContentID) {
                $MasonryContentID = $tile->MasonryContentID;
                $counter = 0;
            }
            $counter++;
            echo "($counter): " . $tile->MasonryContentID . " " . $tile->Title . " " . $tile->SortOrder . "<br>";
            $tile->SortOrder = $counter;
            $tile->write();


        }

    }
}
