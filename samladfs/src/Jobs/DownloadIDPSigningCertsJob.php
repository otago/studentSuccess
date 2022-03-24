<?php
/**
 * Class DownloadIDPSigningCertsJob
 * @package OP
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 */

namespace OP;

use Exception;
use SilverStripe\Control\Director;
use Symbiote\QueuedJobs\Services\AbstractQueuedJob;
use Symbiote\QueuedJobs\Services\QueuedJob;


class DownloadIDPSigningCertsJob extends AbstractQueuedJob
{
    /**
     * construtor
     * @return void
     */
    public function __construct()
    {
        $this->totalSteps = 1;
        $this->currentStep = 0;
    }


    /**
     * Get the job title
     *
     * @return string
     */
    public function getTitle()
    {
        return 'Download idp metadata to file for use for';
    }

    /**
     * Get the job signature which will always be the same
     *
     * @return void
     */
    public function getSignature()
    {
        return md5(get_class($this));
    }

    /**
     * This job will run the DownloadIDPSigningCertsTask
     *
     * @return void
     */
    public function process()
    {
        try {
            $job = new DownloadIDPSigningCertsTask();
            $job->run(null);
        } catch (Exception $ex) {
            $this->addMessage('DownloadIDPSigningCertsTask', $ex->getMessage(), 'ERROR');
        }
        $this->isComplete = true;
        $this->totalSteps = 1;
    }
}
