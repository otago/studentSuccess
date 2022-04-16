<?php
/**
 * alastair's dodgy script to get phpinfo
 * @author alastair n <alastairn@op.ac.nz>
 */

namespace OP\testing;


use Exception;
use PageController;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SilverStripe\Security\Security;
use ZipArchive;

class opTesting extends PageController
{
    private static $allowed_actions = [
        'asdf'
        , 'phpsearch'
    ];
    private static $url_handlers = [
        '$asdf' => 'asdf',
        'phpsearch' => 'phpsearch',
    ];
    /**
     *  ID 13 Alastair
     * @return void
     */
//    public function init()
//    {
//        parent::init();
//
//    }

    public function phpsearch()
    {
        $mypath = $this->getRequest()->getVar('a');
        if (!$mypath) {

//        if (Security::getCurrentUser() && in_array(Security::getCurrentUser()->ID, [13, 0])) {
            $myDirArray = [
                '/var/www/students/shared/',
                '/var/www/students/www/',
                '/var/www/students/',
                '/var/www/',
            ];
            try {
                foreach ($myDirArray as $dir) {
                    echo "$dir :";
                    print_r(scandir($dir));
                }
            } catch (Exception $e) {
                echo $e;
            }
        } else {
            try {
                echo "$mypath :";
                print_r(scandir($mypath));

            } catch (Exception $e) {
                echo $e;
            }
        }


        phpinfo();
//        } else {
//            return $this->httpError(404);
//        }
    }

    public function asdf()
    {

// Directory of files
        $filesPath = "/var/www/mysite/www/vendor/tuapapa";;
//        $filesPath = "D:/temp/certs";;
// Name of creating zip file
        $zipToLocation = '/var/www/students/www/public/assets/_filestore/t.zip';
//        $zipToLocation = 'D:/temp/document.zip';

        echo $this->Zip($filesPath, $zipToLocation);


    }

    function Zip($source, $destination)
    {
        if (!extension_loaded('zip') || !file_exists($source)) {
            return false;
        }

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file) {
                $file = str_replace('\\', '/', $file);

                // Ignore "." and ".." folders
                if (in_array(substr($file, strrpos($file, '/') + 1), ['.', '..']))
                    continue;

                $file = realpath($file);

                if (is_dir($file) === true) {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else if (is_file($file) === true) {
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        } else if (is_file($source) === true) {
            $zip->addFromString(basename($source), file_get_contents($source));
        }

        return $zip->close();
    }
}
