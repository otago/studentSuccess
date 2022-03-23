<?php
namespace OP\Studentsuccess;
use OP\OPMigrateFileTask;
use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;
use SilverStripe\SiteConfig\SiteConfig;

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
	 * @param \SilverStripe\Control\HTTPRequest $request
	 */
	public function run($request) {

        foreach (SiteConfig::get() as $sc) {
            $sc->FeedBackLiteOn =false;
            $sc->write();
        }
        $MigrateFileTask = OPMigrateFileTask::create();
        $MigrateFileTask->run($request);


		echo 'Done! easy ;)';

	}

}
