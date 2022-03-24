<?php
/**
 * handle saml authentication overrides
 *
 * @author torleif west <torleifw@op.ac.nz>
 * @author Alastair Nicholl <Alastair.Nicholl@op.ac.nz>
 */
namespace OP;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\SAML\Helpers\SAMLHelper;
use SilverStripe\Control\Session;
use SilverStripe\Core\Extension;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\Debug;
use SilverStripe\Security\Authenticator;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;
use SilverStripe\ORM\DataExtension;

/**
 * Class OP\SAMLSecurityExtension
 *
 * Extensions to the {@link Security} controller to support {@link SAMLAuthenticator}
 */
class SAMLSecurityExtension extends DataExtension
{
    /**
     * Will redirect the user directly to the IdP login endpoint if:
     *
     * 1) There isn't a GET param showloginform set to 1
     * 2) the member is not currently logged in
     * 3) there are no form messages (errors or notices)
     *
     * @return void
     */
    public function onBeforeSecurityLogin()
    {
        // if authing via realme, bypass the saml check
        if (strpos($this->owner->request->getURL(), '/RealMe/acs') !== false) {
            return;
        }

        // by going to the URL Security/login?showloginform=1 we bypass the auto sign on
        if ($this->owner->request->getVar('showloginform') == 1) {
            return;
        }

        // if member is already logged in, don't auto-sign-on, this is most likely because
        // of insufficient permissions.
        $member = Security::getCurrentUser();
        if ($member && $member->exists()) {
            $backurl = $this->owner->request->getVar('BackURL');
            if ($backurl && Director::is_site_url($backurl)) {
                return  Controller::curr()->redirect($backurl);
            } else {
                return Controller::curr()->redirect(Director::absoluteBaseURL() . 'hub/');
            }
        }


        $request = $this->owner->getRequest();
        $helper = Injector::inst()->get(SAMLHelper::class);
        $helper->redirect(null, $request, $request->getURL(true));
    }
}
