<?php

/**
 * OPCwpBasicAuthMiddleware - allow certain IP addresses from bypassing basic
 * overrise the cwpbasicauthmiddleware
 * HTTP auth
 *
 * @author Alastair Nicholl <alastairn@op.ac.nz>
 */

namespace OP;


use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse_Exception;
use SilverStripe\Core\Config\Config;
use SilverStripe\Security\BasicAuth;
use SilverStripe\Security\BasicAuthMiddleware;
use SilverStripe\Security\Security;
use SilverStripe\SiteConfig\SiteConfig;

class OPBasicAuthMiddleware extends BasicAuthMiddleware
{

    /**
     * Generate response for the given request
     *
     * @param HTTPRequest $request
     * @param callable    $delegate
     * @return HTTPResponse
     */
    public function process(HTTPRequest $request, callable $delegate)
    {
        if (Security::getCurrentUser()) {
            return $delegate($request);
        }
        if (Director::isLive()) {
            return $delegate($request);
        }
        if (Director::is_cli()) {
            return $delegate($request);
        }


        // Check if url matches any patterns
        $match = $this->checkMatchingURL($request);

        // Check middleware unless specifically opting out
        if ($match !== false) {
            $dummyController = new Controller();
            $dummyController->setRequest($request);
            $dummyController->pushCurrent();
            return Security::permissionFailure($dummyController);
        }
        // Pass on to other middlewares
        return $delegate($request);

    }

    /**
     * Check for any whitelisted IP addresses. If one matches the current user's IP then return false early,
     * otherwise allow the default {@link BasicAuthMiddleware} to continue its logic.
     *
     * @param HTTPRequest $request
     * @return HTTPResponse
     */
    protected function checkMatchingURL(HTTPRequest $request)
    {
        if (strpos($request->getURL(), 'Security') !== false) {
            return false;
        }
        if (strpos($request->getURL(), 'saml') !== false) {
            return false;
        }
        if (Director::is_ajax() || Director::is_cli()) {
            return false;
        }

        $remoteip = $_SERVER['REMOTE_ADDR'];
        //if at op return false
        if (preg_match("/^202\.49\.0\.*/", $remoteip)) {
            return false;
        }
        return true;
    }
}
