<?php

namespace OP\studentsuccess;



use SilverStripe\ORM\DB;
use SilverStripe\Dev\BuildTask;



/**
 * Creates the first instances of Otago Polytechnic jobs. These are jobs that
 * are called repeatedly, on a scheduled basis. It leverages SilverStripes
 * queuedjobs add on
 * 
 * @package cms
 * @subpackage assets
 */
class CreateJobsTask extends BuildTask {

	protected $title = "Create sss Scheduled Jobs";
	protected $description = "Clear ALL jobs and add only OP jobs to queue";

	/**
	 * submit Application data to EBS
	 * @param type $request
	 */
	public function run($request) {
		// Note this is MySQL only. A for loop will not work on CWP UAT.
		$count = DB::query('DELETE FROM `QueuedJobDescriptor` WHERE "JobStatus" <> \'Complete\'')->value();
		//print_r($count);


		
		echo 'Done! easy ;)';

	}

}
