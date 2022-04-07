<?php
/**
 * Class SAMLHelperFunctions
 * @package OP
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 *
 * Class of helper functions for saml
 */

namespace OP;
use Exception;
use OneLogin\Saml2\IdPMetadataParser;
use SilverStripe\Assets\Filesystem;
use SilverStripe\Assets\Folder;
use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Environment;


class SAMLHelperFunctions
{
    use Configurable;

    /**
     * @return array
     */
    public static function SamlConfig()
    {
        $env = Environment::getEnv('SS_ENVIRONMENT_TYPE');

        // Configure SAML certificates for the CWP Production environment
        if ($env == 'prod') {
            $samlconfig = SAMLHelperFunctions::config()->get('prod');

            //
            if (!Director::is_cli() && $_SERVER['HTTP_HOST'] == 'hub.op.ac.nz') {
                $samlconfig["entityId"] = 'https://hub.op.ac.nz';
                $samlconfig["logoutURL"] = 'https://hub.op.ac.nz/saml/sls';
            }
        } else {
            //if not cli then set server name from http, eg central-op-uat.cwp.govt.nz
            if (Director::is_cli()) {
                $serverName = "";
            } else {
                $serverName = $_SERVER['HTTP_HOST'];
            }
            //dev isn't a CWP_ENVIRONMENT so set env to dev
            if (Director::isDev()) {
                $env = 'dev';
            }

            $samlconfig = SAMLHelperFunctions::config()->get($env);
            $samlconfig["entityId"] = 'https://' . $serverName;
            $samlconfig["logoutURL"] = 'https://' . $serverName . '/saml/sls';
        }
        var_dump($env);
var_dump($samlconfig);
//        die();
        return $samlconfig;
    }


    /**
     * @return array
     */
    public static function IDPConfig()
    {
        $samlconfig = SAMLHelperFunctions::SamlConfig();
        return SAMLHelperFunctions::config()->get($samlconfig['idpEndpoint']);
    }

    /**
     * Downloads metadata from IDP for use for saml and adfs
     * @return array
     * @throws \Exception
     */
    public static function DownloadMetaDataFromIDP()
    {
        $idpconfig = SAMLHelperFunctions::IDPConfig();
        $SamlConfig = SAMLHelperFunctions::SamlConfig();





        Filesystem::makeFolder(ASSETS_DIR.SAMLHelperFunctions::config()->get('filepath'));

        $retval = [];
        $FilePath = SAMLHelperFunctions::MetadataFilePath();

        $MetadatafileLocation = $idpconfig["metadata"];
        $retval[] = $MetadatafileLocation;
        $retval[] = $FilePath;
        $MetaDataXML = SAMLHelperFunctions::fetchData($MetadatafileLocation);

        $MetaData = IdPMetadataParser::parseXML($MetaDataXML);

        $OrginalFile = null;
        if (file_exists($FilePath)) {
            $OrginalFile = file_get_contents($FilePath);
        }
        $MetaDataFailure = false;

        if (isset($MetaData["idp"]['x509certMulti']['signing'])) {
            $retval[] = "Create Files";
            file_put_contents($FilePath, $MetaDataXML);

            $MetaData = IdPMetadataParser::parseFileXML($FilePath);

            //check
            if (isset($MetaData["idp"]['x509certMulti']['signing'])) {
                $retval[] =  "File is correct";
            } elseif ($OrginalFile != null) {
                //if unsuccessful put the orginal file back
                file_put_contents($FilePath, $OrginalFile);
                $retval[] =  "File is NOT correct, REVERTING TO  orginalfile";
                $MetaDataFailure = true;
            }
        } else {
            $retval[] =  "File didn't have any signing cert data, did not touch orginal file";
            $MetaDataFailure = true;
        }

        if ($MetaDataFailure) {
            $message = "metadata file bad:\n\n <br>" . implode(" <br>\n", $retval);
          //  LoggedEmail::create("webmaster@op.ac.nz", "alastairn@op.ac.nz", "IDP ", $message)->send();
          //  LoggedEmail::create("webmaster@op.ac.nz", "Torleif.West@op.ac.nz", "IDP ", $message)->send();
        }
        return $retval;
    }

    /**
     * @return string
     */
    public static function MetadataFilePath()
    {
        return $FilePath = ASSETS_PATH .  SAMLHelperFunctions::config()->get("filepath") . Director::get_environment_type() . "idpmetadata.xml";
    }

    /**
     * @return array
     * @throws \Exception
     */
    public static function IDPMetaData()
    {
        $FilePath = SAMLHelperFunctions::MetaDataFilePath();

        if (!file_exists($FilePath)) {
            SAMLHelperFunctions::DownloadMetaDataFromIDP();
        }

        return IdPMetadataParser::parseFileXML($FilePath);
    }

    /**
     * @param string $url
     * @return bool|string
     */
    private static function fetchData($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        // follow 3** requests
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        //CWP proxy stuff
        if (Environment::getEnv('SS_OUTBOUND_PROXY') && Environment::getEnv('SS_OUTBOUND_PROXY_PORT')) {
            curl_setopt($ch, CURLOPT_PROXY, Environment::getEnv('SS_OUTBOUND_PROXY'));
            curl_setopt($ch, CURLOPT_PROXYPORT, Environment::getEnv('SS_OUTBOUND_PROXY_PORT'));
        }
        $result = curl_exec($ch);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {
            throw new Exception('Failed to fetech ' . $url . ' Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}
