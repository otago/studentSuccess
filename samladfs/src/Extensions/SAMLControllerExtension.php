<?php

/**
 * Class SAMLControllerExtension
 * @package OP
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 * Override the SAMLController - Otago Polytechnic authentication does two things differently:
 * 1) Align old accounts that don't have GUIDs (that were created before the SilverStripe activedirectory module was created)
 * 2) handle federated sign out
 */

namespace OP;

use SilverStripe\Control\HTTPResponse_Exception;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Control\Director;
use SilverStripe\Forms\Form;
use SilverStripe\Control\Session;
use SilverStripe\Security\Member;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\Controller;
use SilverStripe\SAML\Control\SAMLController;
use SilverStripe\SAML\Helpers\SAMLHelper;
use SilverStripe\Security\IdentityStore;
use SilverStripe\Security\Security;
use SilverStripe\SAML\Services\SAMLConfiguration;
use SilverStripe\ORM\ValidationResult;
use OneLogin\Saml2\Utils;
use Exception;
use SilverStripe\Security\MemberAuthenticator\SessionAuthenticationHandler;
use SilverStripe\Security\RequestAuthenticationHandler;

class SAMLControllerExtension extends SAMLController
{

    private static $allowed_actions = array(
        'index',
        'login',
        'logout',
        'acs',
        'sls',
        'metadata'
    );

    /**
     * search the attributes and find the email (based on upn of the user)
     * @param array $arrs
     * @return string|null
     */
    public function getEmailFromAttributes(array $arrs)
    {
        $email = null;
        if (is_array($arrs)) {
            foreach ($arrs as $key => $claim) {
                if (strpos($key, 'claims/upn') !== false) {
                    $email = current($claim);
                }
            }
        }
        return $email;
    }

    /**
     * search the attributes and find the email attribute
     * @param array $arrs
     * @return string|null
     */
    public function getEmailAttribute(array $arrs)
    {
        $email = null;
        if (is_array($arrs)) {
            foreach ($arrs as $key => $claim) {
                if (strpos($key, 'claims/emailaddress') !== false) {
                    $email = current($claim);
                }
            }
        }
        return $email;
    }

    /**
     * Given a GUID, create or find a user
     * @param string $guid
     * @param array  $attributes
     * @return Member
     */
    public function FindMember($guid, array &$attributes)
    {
        $member = Member::get()->filter('GUID', $guid)->limit(1)->first();

        if (!($member && $member->exists())) {
            $mail = $this->getEmailFromAttributes($attributes);

            // try to find based on email here
            if ($mail) {
                $member = Member::get()->filter('Email', $mail)->limit(1)->first();
            }
            if (!$member) {
                $mail = $this->getEmailAttribute($attributes);
                if ($mail) {
                    $member = Member::get()->filter('Email', $mail)->limit(1)->first();
                }
            }

            if ($member) {
                $member->GUID = $guid;
            }

            // one more test, then create a new member
            if (!($member && $member->exists())) {
                return false;
            }
        }

        foreach ($member->config()->claims_field_mappings as $claim => $field) {
            if (!isset($attributes[$claim][0])) {
                if (strpos($claim, 'studentid') === false &&  strpos($claim, 'employeeID') === false) { //ignore if studentid is not there, as staff don't have studentid
                    $this->getLogger()->warning(
                        sprintf(
                            'Claim rule \'%s\' configured in LDAPMember.claims_field_mappings, ' .
                                'but wasn\'t passed through. Please check IdP claim rules.',
                            $claim
                        )
                    );
                }

                continue;
            }

            $member->$field = $attributes[$claim][0];
        }
        return $member;
    }

    /**
     * @return \SilverStripe\Control\HTTPResponse|null
     * @throws \SilverStripe\ORM\ValidationException
     */
    public function acs()
    {
        /** @var \OneLogin_Saml2_Auth $auth */
        $auth = Injector::inst()->get(SAMLHelper::class)->getSAMLAuth();
        $caughtException = null;

        // Force php-saml module to use the current absolute base URL (e.g. https://www.example.com/saml). This avoids
        // errors that we otherwise get when having a multi-directory ACS URL like /saml/acs).
        // See https://github.com/onelogin/php-saml/issues/249
        Utils::setBaseURL(Controller::join_links($auth->getSettings()->getSPData()['entityId'], 'saml'));

        // Attempt to process the SAML response. If there are errors during this, log them and redirect to the generic
        // error page. Note: This does not necessarily include all SAML errors (e.g. we still need to confirm if the
        // user is authenticated after this block
        try {
            $auth->processResponse();
            $error = $auth->getLastErrorReason();
        } catch (Exception $e) {
            $caughtException = $e;
        }
        $request = $this->getRequest();
        //die("33333333333");
        // If there was an issue with the SAML response, if it was missing or if the SAML response indicates that they
        // aren't authorised, then log the issue and provide a traceable error back to the user via the LoginForm
        if ($caughtException || !empty($error) || !$auth->isAuthenticated()) {
            // Log both errors (reported by php-saml and thrown as exception) with a common ID for later tracking
            $id = uniqid('SAML-');

            if ($caughtException instanceof Exception) {
                $this->getLogger()->error(sprintf(
                    '[%s] [code: %s] %s (%s:%s)',
                    $id,
                    $e->getCode(),
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine()
                ));
            }

            if (!empty($error)) {
                $this->getLogger()->error(sprintf('[%s] %s', $id, $error));
            }

            // Redirect the user back to the login form to display the generic error message and reference
            $this->getRequest()->getSession()->save($this->getRequest());
            return $this->redirect('Security/login');
        }
    //    die("uuuuuuuuuuuu");
        // If processing reaches here, then the user is authenticated - the rest of this method is just processing their
        // legitimate information and configuring their account.

        // Check that the NameID is a binary string (which signals that it is a guid
        $decodedNameId = base64_decode($auth->getNameId());
        $request->getSession()->set('SAMLNAME', $auth->getNameId());
        if (ctype_print($decodedNameId)) {
            $this->getLogger()->error('NameID from IdP is not a binary GUID.');
            return $this->getRedirect();
        }

        // transform the NameId to guid
        $helper = SAMLHelper::singleton();
        $guid = $helper->binToStrGuid($decodedNameId);
        if (!$helper->validGuid($guid)) {
            $errorMessage = "Not a valid GUID '{$guid}' recieved from server.";
            $this->getLogger()->error($errorMessage);
            return $this->getRedirect();
        }

        // Write a rudimentary member with basic fields on every login, so that we at least have something
        // if LDAP synchronisation fails.
        $attributes = $auth->getAttributes();
        $member = $this->FindMember($guid, $attributes);

        if ($member === false) {
            //throw new HTTPResponse_Exception('no dogs allowed', 404);
            return $this->redirect(Director::absoluteBaseURL() );
        }

        $member->SAMLSessionIndex = $auth->getSessionIndex();
        $member->write();

        /** @var IdentityStore $identityStore */
        $identityStore = Injector::inst()->get(IdentityStore::class);
        $persistent = Security::config()->get('autologin_enabled');
        $identityStore->logIn($member, $persistent, $this->getRequest());

        return $this->getRedirect();
    }


    /**
     * because we've modified the route to point right to this controller - we have
     * to handle the log out as the main index of this controller
     * @return void
     */
    public function index()
    {
        if (Controller::curr()->getRequest()->getURL() == 'Security/logout') {
            $this->logout();
        }
        return $this->redirect('/');
    }

    /**
     * logout function - calls the logout handler based on the saml name
     * @return void
     */
    public function logout()
    {
        $auth = Injector::inst()->get(SAMLHelper::class)->getSAMLAuth();
        $request = Controller::curr()->getRequest();

        $SAMLConfiguration = new SAMLConfiguration();
        $sp = $SAMLConfiguration->config()->get('SP');
        $samlname = $request->getSession()->get('SAMLNAME');

        Injector::inst()->get(IdentityStore::class)->logOut(Controller::curr()->getRequest());
        Security::getCurrentUser() ? Security::setCurrentUser(null)  : '';

        $auth->logout(Director::absoluteBaseURL(), array(), $samlname);
    }

    /**
     * the user gets redireced here after successfully logging out. all this
     * does is redirect the user to the hub
     * @return \SS_HTTPRequest
     */
    public function sls()
    {
        Injector::inst()->get(IdentityStore::class)->logOut(Controller::curr()->getRequest());
        // we go home - going back to the hub will cause a log in!
        return $this->redirect(Director::absoluteBaseURL());
    }

    /**
     * Generate this SP's metadata. This is needed for intialising the SP-IdP relationship.
     * IdP is instructed to call us back here to establish the relationship. IdP may also be configured
     * to hit this endpoint periodically during normal operation, to check the SP availability.
     * @return void
     */
    public function metadata()
    {
        $this->response->addHeader("Content-Type", "application/xml");
        parent::metadata();
    }
}
