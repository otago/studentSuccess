<?php
/**
 * allows the holder of the trait to use a logging function with timestamp
 * @author torleif west <torleifw@op.ac.nz>
 */
namespace OP;

use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\Security\Member;
use SilverStripe\Control\Director;
use SilverStripe\Core\Injector\Injector;
use Psr\Log\LoggerInterface;
use Exception;


trait LoggingTrait
{
    protected $verbose = true;
    protected $MultiLog = "";
    /**
     * Will echo, or log what's happening
     *
     * @param string $str     message to log
     * @param string $htmltag an <html> tag for formatting the message
     * @return void
     */
    public function log($str, $htmltag = null)
    {
        $datestamp = '[' . date('Y-m-d H:i:s') . ']';
        if (!Director::is_cli() && !Director::is_ajax()) {
            if ($this->verbose) {
                if ($htmltag) {
                    echo "<$htmltag>$datestamp $str</$htmltag><br/>";
                } else {
                    echo "$datestamp $str<br/>";
                }
            }
        } else {
            echo "$datestamp $str\n";
        }
        Injector::inst()->get(LoggerInterface::class)->info(get_class() . ': ' . $str);
    }

    /**
     * Will this task echo information?
     *
     * @param Boolean $v if false, logging will not echo while running via web interface
     * @return void
     */
    public function setVerbose($v)
    {
        $this->verbose = $v;
    }

    /**
     * Will echo, or log what's happening
     *
     * @param string $str message to log
     * @return void
     */
    public static function info($str)
    {
        Injector::inst()->get(LoggerInterface::class)->info(get_class() . ': ' . $str);
    }


    /**
     * @param string $str
     * @return void
     */
    public function addTologMessage($str)
    {
        $datestamp = '[' . date('Y-m-d H:i:s') . ']';
        $this->MultiLog .= $datestamp . " " . $str . "\n";
    }

    /**
     * @param bool $echo
     * @return void
     */
    public function logMultiLogMessage($echo = true)
    {
        if ($echo == true) {
            echo $this->MultiLog;
        }
        Injector::inst()->get(LoggerInterface::class)->info(get_class() . ': ' . $this->MultiLog);

        //once sent to log clear multi log
        $this->MultiLog = "";
    }
}
