<?php
namespace OP\Studentsuccess;
use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;

/**
 *
 * @package cms
 * @subpackage assets
 */
class SSSAssetsTask extends BuildTask {

	protected $title = "SSSAssetsTask";
	protected $description = "SSSAssetsTask";

	/**
	 *
	 * @param type $request
	 */
	public function run($request) {

//		$count = DB::query('UPDATE sss2.File SET Filename =  REPLACE(filename, \'assets/Uploads/\', \'Uploads/\') WHERE ID > 0;');

		echo 'Done! easy ;)';

	}

}
