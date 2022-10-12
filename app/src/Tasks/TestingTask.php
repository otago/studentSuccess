<?php
/**
 * Class DownloadIDPSigningCertsTask
 * @package OP
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 *
 * Downloads metadata from IDP for use for saml and adfs
 */
namespace OP;

use SilverStripe\Dev\BuildTask;


class TestingTask extends BuildTask
{
  //  use LoggingTrait;

    /**
     * @var string
     */
    protected $title = "TestingTask";
    /**
     * @var string
     */
    protected $description = "TestingTask";

    /**
     * @param \SilverStripe\Control\HTTPRequest $request
     * @return void
     * @throws \Exception
     */
    public function run($request)
    {
        echo exec("php --ini");

        phpinfo();
    }
}
