<?php
/**
 * alastair's dodgy script to get phpinfo
 * @author alastair n <alastairn@op.ac.nz>
 */

namespace OP\testing;


use Exception;
use PageController;
use SilverStripe\Security\Security;

class opTesting extends PageController
{

    /**
     *  ID 13 Alastair
     * @return void
     */
    public function init()
    {
        parent::init();
        $mypath = $this->getRequest()->getVar('a');
        if (!$mypath ) {

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
}
