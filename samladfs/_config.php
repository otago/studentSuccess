<?php
/**
 * dymaic settings for SAML
 * @author alastair n <alastairn@op.ac.nz>
 */

use OP\SAMLHelperFunctions;
use SilverStripe\Core\Config\Config;
use SilverStripe\SAML\Services\SAMLConfiguration;


Config::modify()->set(SAMLConfiguration::class, 'SP', SAMLHelperFunctions::SamlConfig());
Config::modify()->set(SAMLConfiguration::class, 'IdP', SAMLHelperFunctions::IDPConfig());
