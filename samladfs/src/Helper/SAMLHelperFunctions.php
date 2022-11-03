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
use Psr\Log\LoggerInterface;
use SilverStripe\Assets\Filesystem;
use SilverStripe\Assets\Folder;
use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Environment;
use SilverStripe\Core\Injector\Injector;


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
        if ($env == 'live') {
            $samlconfig = SAMLHelperFunctions::config()->get('prod');
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

            $samlconfig= SAMLHelperFunctions::config()->get($env);


            $samlconfig["entityId"] = 'https://' . $serverName;
            $samlconfig["logoutURL"] = 'https://' . $serverName . '/saml/sls';
        }
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

        $retval = [];
        echo "0";
        $filepath = ASSETS_DIR . SAMLHelperFunctions::config()->get('filepath');
        $retval[] = "Whole: " . ASSETS_DIR . SAMLHelperFunctions::config()->get('filepath');
        $retval[] = "asets: " . ASSETS_DIR ;
        $retval[] = "conf:  " . SAMLHelperFunctions::config()->get('filepath') ;
        $retval[] = "filepath:  " . $filepath ;
        $retval[] = file_exists(dirname($filepath));

        var_dump($retval);


        if (!file_exists(dirname($filepath))) {
            SAMLHelperFunctions::log( "ddddddddddddddddddddddd:".$filepath);
            Filesystem::makeFolder($filepath);
        }


        SAMLHelperFunctions::log( "sssssssssssssssssss");
        return $retval;
        SAMLHelperFunctions::log( "1");

        $FilePath = SAMLHelperFunctions::MetadataFilePath();
        SAMLHelperFunctions::log( "2");
        $MetadatafileLocation = $idpconfig["metadata"];
        $retval[] = $MetadatafileLocation;
        $retval[] = $FilePath;
        $MetaDataXML = SAMLHelperFunctions::fetchData($MetadatafileLocation);

        $MetaData = IdPMetadataParser::parseXML($MetaDataXML);
        SAMLHelperFunctions::log( "3");
        $OrginalFile = null;
        if (file_exists($FilePath)) {
            SAMLHelperFunctions::log( "3aa");
            $OrginalFile = file_get_contents($FilePath);
            SAMLHelperFunctions::log( "3bb");
        }
        $MetaDataFailure = false;
        SAMLHelperFunctions::log( "4");
        if (isset($MetaData["idp"]['x509certMulti']['signing'])) {
            $retval[] = "Create Files";
            SAMLHelperFunctions::log( "4aa");
            file_put_contents($FilePath, $MetaDataXML);
            SAMLHelperFunctions::log( "4bb");
            $MetaData = IdPMetadataParser::parseFileXML($FilePath);

            //check
            if (isset($MetaData["idp"]['x509certMulti']['signing'])) {
                $retval[] =  "File is correct";
            } elseif ($OrginalFile != null) {
                //if unsuccessful put the orginal file back
                SAMLHelperFunctions::log( "4cc");
                file_put_contents($FilePath, $OrginalFile);
                SAMLHelperFunctions::log( "4dd");
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
        $idp = SAMLHelperFunctions::SamlConfig();;
        return $FilePath = ASSETS_PATH .  SAMLHelperFunctions::config()->get("filepath") . $idp['idpEndpoint'] . "metadata.xml";
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

    public static function log($str, $htmltag = null)
    {
        $datestamp = '[' . date('Y-m-d H:i:s') . ']';

        echo "$datestamp $str\n";

        Injector::inst()->get(LoggerInterface::class)->info(get_class() . ': ' . $str);
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
