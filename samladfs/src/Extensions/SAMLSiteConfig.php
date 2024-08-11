<?php
/**
 * handle saml authentication overrides
 *
 * @author torleif west <torleifw@op.ac.nz>
 * @author Alastair Nicholl <Alastair.Nicholl@op.ac.nz>
 */

namespace OP;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DB;
use SilverStripe\SiteConfig\SiteConfig;


class SAMLSiteConfig extends DataExtension
{
    private static $db = [
        'DisableForcedUATAuth' => "Boolean",
    ];

    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();
        foreach (SiteConfig::get() as $mysiteconfig) {
            //if auth is disabled, then re-enable it
            if ($mysiteconfig->DisableForcedUATAuth == true) {
                $mysiteconfig->DisableForcedUATAuth = false;
                $mysiteconfig->write();
                DB::alteration_message($mysiteconfig->title . " " . $mysiteconfig->ID . ": Set DisableTestingAuth to false", "changed");
            }
        }
    }

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root.Main',
            CheckboxField::create('DisableForcedUATAuth', 'Disable UAT  authentication requirement')
                ->setDescription('While not on premise, SAML authentication is required. This wil bypass this on UAT')
        );
    }
}
