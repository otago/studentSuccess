<?php


/**
 * OPCwpControllerExtension - allow certain IP addresses from bypassing basic 
 * HTTP auth
 *
 * @author torleifw
 */
class OPCwpControllerExtension extends CwpControllerExtension {

	protected function triggerBasicAuthProtection() {
		// Allow whitelisting IPs for bypassing the basic auth.
		if (defined('OP_CWP_IP_BYPASS_BASICAUTH')) {
			$remote = $_SERVER['REMOTE_ADDR'];
			$bypass = explode(',', OP_CWP_IP_BYPASS_BASICAUTH);
			if (in_array($remote, $bypass)) {
				return true;
			}
		}
		return parent::triggerBasicAuthProtection();
	}

}
