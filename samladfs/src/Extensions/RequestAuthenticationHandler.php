<?php
/**
 * handles authentication.
 * We have many expensive calls coming off member->write(), and the
 * default SS behaviour is to call write() mutliple times. this prevents this.
 * @author torleif west <torleifw@op.ac.nz>
 */
namespace OP;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Security\Member;
use SilverStripe\Security\RequestAuthenticationHandler as SecurityRequestAuthenticationHandler;
use SilverStripe\Security\Security;

class RequestAuthenticationHandler extends SecurityRequestAuthenticationHandler
{

    /**
     * Log into the identity-store handlers attached to this request filter
     *
     * @param Member      $member
     * @param bool        $persistent
     * @param HTTPRequest $request
     * @return void
     */
    public function logIn(Member $member, $persistent = false, HTTPRequest $request = null)
    {
        foreach ($this->getHandlers() as $handler) {
            $handler->logIn($member, $persistent, $request);
        }

        Security::setCurrentUser($member);
    }
}
