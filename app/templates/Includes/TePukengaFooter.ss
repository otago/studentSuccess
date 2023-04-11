<% require css('themes/otp/css/tepukenga-footer.css') %>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
<div class="tp-footer">
    <div class="tp-footer__section">
        <div class="tp-footer__logo--type-tepukenga">
            <a href="https://xn--tepkenga-szb.ac.nz/" target="_blank">
                <img src="/resources/themes/otp/images/tepukenga.png" />
            </a>
        </div>
        <div class="tp-footer__tagline">
            Otago Polytechnic is part of Te Pūkenga - New Zealand Institute of Skills and Technology <a href="https://www.op.ac.nz/about-us/te-pukenga" target="_blank">Learn more</a>
        </div>
    </div>
    <div class="tp-footer__line"></div>
    <div class="tp-footer__section tp-footer__section--type-bottom">
        <div class="tp-footer__section tp-footer__section--type-stack tp-footer__section--type-start tp-footer__section--type-big-gap">
            <div class="tp-footer__section">
                <div>
                    <strong>Learn with purpose</strong>
                </div>
                <div class="tp-footer__button">
                    <a href="https://xn--tepkenga-szb.ac.nz/programme/search" target="_blank">Explore Te Pūkenga</a>
                </div>
            </div>
            <div class="tp-footer__section">

                <div class="tp-footer__links">
                    <a href="https://xn--tepkenga-szb.ac.nz/about-us/" target="_blank">About Te Pūkenga</a>
                    <a href="https://www.op.ac.nz/about-us/governance-and-management/policy-library/disclosing-personal-information-about-learners-and-staff-policy/" target="_blank">Privacy Policy</a>

                </div>
                <% with $SiteConfig %>
                    <div class='container addresses'>

                        <% if $TelephoneInternational || $TelephoneNewZealand || $ContactEmail %>
                        <div class='large-col col'>
                            <p>
                                <strong>Contact Otago Polytechnic</strong><br>
                                <% if $TelephoneInternational %>International <a href='tel:{$TelephoneInternational}'>{$TelephoneInternational}</a><br><% end_if %>
                                <% if $TelephoneNewZealand %>New Zealand <a href='tet:{$TelephoneNewZealand}'>{$TelephoneNewZealand}</a><br><% end_if %>
                                <a href="https://www.op.ac.nz/about/important-information/in-an-emergency/">In an emergency 4177</a><br>
                                <% if $TelephoneInternational %>Your suggestions are welcome, please email <a href='mailto:{$ContactEmail}'>{$ContactEmail}</a><% end_if %>
                            </p>
                        </div>
                        <% end_if %>

                    </div>
                <% end_with %>
            </div>
        </div>

        <div class="tp-footer__section tp-footer__section--type-stack tp-footer__section--type-end">
            <div class="tp-footer__logo--type-nzgovernment">
                <a href="https://www.govt.nz/" target="_blank">
                    <img src="/resources/themes/otp/images/nz_government.png" />
                </a>
            </div>
            <div></div>
        </div>


    </div>
    <% with $SiteConfig %>
        <div class="creativecommons">
            <span class="creativecommonsimg">{$CreativeCommonsLicenceImage}</span><span>{$CreativeCommonsLicence}</span>
        </div>
    <% end_with %>
</div>
