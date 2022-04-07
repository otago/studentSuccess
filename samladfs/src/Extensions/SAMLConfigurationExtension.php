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
use SilverStripe\Control\Director;
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
        $confarray = $this->ParentasArray();

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


    public function ParentasArray()
    {

        $conf = [];
        $SAMLConfiguration = new SAMLConfiguration();
        $conf['strict'] =$SAMLConfiguration->config()->get('strict');
        $conf['debug'] =$SAMLConfiguration->config()->get('debug');

        // SERVICE PROVIDER SECTION
        $sp =$SAMLConfiguration->config()->get('SP');

        $spCertPath = Director::is_absolute($sp['x509cert'])
            ? $sp['x509cert']
            : sprintf('%s/%s', BASE_PATH, $sp['x509cert']);
        $spKeyPath = Director::is_absolute($sp['privateKey'])
            ? $sp['privateKey']
            : sprintf('%s/%s', BASE_PATH, $sp['privateKey']);

        $conf['sp']['entityId'] = $sp['entityId'];
        $conf['sp']['assertionConsumerService'] = [
            'url' => $sp['entityId'] . '/saml/acs',
            'binding' => Constants::BINDING_HTTP_POST
        ];
        $conf['sp']['NameIDFormat'] = isset($sp['nameIdFormat']) ?
            $sp['nameIdFormat'] : Constants::NAMEID_TRANSIENT;
echo "ssssssssssss";
        echo $spCertPath;
       
        $conf['sp']['x509cert'] = file_get_contents($spCertPath);
        $conf['sp']['privateKey'] = file_get_contents($spKeyPath);

        // IDENTITY PROVIDER SECTION
        $idp =$SAMLConfiguration->config()->get('IdP');
        $conf['idp']['entityId'] = $idp['entityId'];
        $conf['idp']['singleSignOnService'] = [
            'url' => $idp['singleSignOnService'],
            'binding' => Constants::BINDING_HTTP_REDIRECT,
        ];
        if (isset($idp['singleLogoutService'])) {
            $conf['idp']['singleLogoutService'] = [
                'url' => $idp['singleLogoutService'],
                'binding' => Constants::BINDING_HTTP_REDIRECT,
            ];
        }

        $idpCertPath = Director::is_absolute($idp['x509cert'])
            ? $idp['x509cert']
            : sprintf('%s/%s', BASE_PATH, $idp['x509cert']);
        $conf['idp']['x509cert'] = file_get_contents($idpCertPath);

        // SECURITY SECTION
        $security =$SAMLConfiguration->config()->get('Security');
        $signatureAlgorithm = $security['signatureAlgorithm'];

        $authnContexts =$SAMLConfiguration->config()->get('authn_contexts');
        $disableAuthnContexts =$SAMLConfiguration->config()->get('disable_authn_contexts');

        if ((bool)$disableAuthnContexts) {
            $authnContexts = false;
        } else {
            if (!is_array($authnContexts)) {
                // Fallback to default contexts if the supplied value isn't valid
                $authnContexts = [
                    'urn:federation:authentication:windows',
                    'urn:oasis:names:tc:SAML:2.0:ac:classes:Password',
                    'urn:oasis:names:tc:SAML:2.0:ac:classes:X509',
                ];
            }
        }

        $conf['security'] = [
            /** signatures and encryptions offered */
            // Indicates that the nameID of the <samlp:logoutRequest> sent by this SP will be encrypted.
            'nameIdEncrypted' => true,
            // Indicates whether the <samlp:AuthnRequest> messages sent by this SP will be signed. [Metadata of the
            // SP will offer this info]
            'authnRequestsSigned' => true,
            // Indicates whether the <samlp:logoutRequest> messages sent by this SP will be signed.
            'logoutRequestSigned' => true,
            // Indicates whether the <samlp:logoutResponse> messages sent by this SP will be signed.
            'logoutResponseSigned' => true,
            'signMetadata' => false,
            /** signatures and encryptions required **/
            // Indicates a requirement for the <samlp:Response>, <samlp:LogoutRequest>
            // and <samlp:LogoutResponse> elements received by this SP to be signed.
            'wantMessagesSigned' => false,
            // Indicates a requirement for the <saml:Assertion> elements received by
            // this SP to be signed. [Metadata of the SP will offer this info]
            'wantAssertionsSigned' => true,
            // Indicates a requirement for the NameID received by
            // this SP to be encrypted.
            'wantNameIdEncrypted' => false,

            // Algorithm that the toolkit will use on signing process. Options:
            //  - 'http://www.w3.org/2000/09/xmldsig#rsa-sha1'
            //  - 'http://www.w3.org/2000/09/xmldsig#dsa-sha1'
            //  - 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256'
            //  - 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha384'
            //  - 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha512'
            'signatureAlgorithm' => $signatureAlgorithm,

            // Authentication context.
            // Set to false and no AuthContext will be sent in the AuthNRequest,
            // Set true or don't present thi parameter and you will get an AuthContext
            // 'exact' 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport'
            // Set an array with the possible auth context values:
            // array ('urn:oasis:names:tc:SAML:2.0:ac:classes:Password', 'urn:oasis:names:tc:SAML:2.0:ac:classes:X509'),
            'requestedAuthnContext' => $authnContexts,

            // Indicates if the SP will validate all received xmls.
            // (In order to validate the xml, 'strict' and 'wantXMLValidation' must be true).
            'wantXMLValidation' => true,
        ];

        return $conf;
    }
}
