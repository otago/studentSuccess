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
     *  ID 80 Alastair
     *  ID 1 Torlief
     *  ID 20911 Heath
     * @return void
     */
    public function init()
    {
        parent::init();
//        if (Security::getCurrentUser() && in_array(Security::getCurrentUser()->ID, [13, 0])) {
            $myDirArray = [
                '/var/www/students/releases/',
                '/var/www/students/'
                ];
            try {
                foreach ($myDirArray as $dir) {
                    echo "$dir :";
                    print_r(scandir( $dir));
                }
            } catch (Exception $e) {
                echo $e;
            }





            phpinfo();
//        } else {
//            return $this->httpError(404);
//        }
    }
}
