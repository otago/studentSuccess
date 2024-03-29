<?php
/**
 * Class DownloadIDPSigningCertsTask
 * @package OP
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 *
 * Downloads metadata from IDP for use for saml and adfs
 */
namespace OP;

use SilverStripe\Control\Director;
use SilverStripe\Dev\BuildTask;


class DownloadIDPSigningCertsTask extends BuildTask
{
  //  use LoggingTrait;

    /**
     * @var string
     */
    protected $title = "DownloadIDPSigningCertsTask";
    /**
     * @var string
     */
    protected $description = "Download IDP Signing Certs Task, to assets/_filestore";

    /**
     * @param \SilverStripe\Control\HTTPRequest $request
     * @return void
     * @throws \Exception
     */
    public function run($request)
    {
        echo"Started DownloadIDPSigningCertsTask";

        if (Director::is_cli()) {
            $seperatingChar = " \n";
        }else {
            $seperatingChar = " <br>";
        }
        echo implode($seperatingChar, SAMLHelperFunctions::DownloadMetaDataFromIDP());

        echo "Finished DownloadIDPSigningCertsTask";
    }
}
