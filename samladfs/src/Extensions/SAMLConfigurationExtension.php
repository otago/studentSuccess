<?php
/**
 * Class SAMLConfigurationExtension
 *
 * Injector
 *
 * We modify the saml configuration to include the logout url and not to encrypt
 * the outgoing name
 * @package OP
 * @author Alastair Nicholl <alastair.nicholl@op.ac.nz>
 */

namespace OP;
use OneLogin\Saml2\IdPMetadataParser;
use SilverStripe\Core\Environment;
use SilverStripe\Dev\Debug;
use SilverStripe\SAML\Services\SAMLConfiguration;
use OneLogin\Saml2\Constants;



class SAMLConfigurationExtension
{

    /**
     * @return array
     */
    public function asArray()
    {
        $idpMetaData =  SAMLHelperFunctions::IDPMetaData();

        $SAMLConfiguration = new SAMLConfiguration();
        $sp = $SAMLConfiguration->config()->get('SP');
        $confarray = $SAMLConfiguration->asArray();

        // don't encrypt the name - this module only supports SHA-1
        $confarray['security']['nameIdEncrypted'] = false;

        $idpMetaData =  SAMLHelperFunctions::IDPMetaData();
        $signing["idp"]['x509certMulti']['signing'] = $idpMetaData["idp"]['x509certMulti']['signing'];

        // add the URL Location where the <Response> from the IdP will be returned
        $confarray = array_merge_recursive(
            $confarray,
            [
                'sp' => [
                    'singleLogoutService' => [
                    "Binding" => Constants::BINDING_HTTP_REDIRECT,
                    "url" => $sp['logoutURL']
                    ]
                ]
            ],
            $signing
        );

        return $confarray;
    }
}
