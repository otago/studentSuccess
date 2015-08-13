<footer class='main'>

    <% with $SiteConfig %>
    <section class='container'>

        <section class='large-col col'>
            <h2><a href='{$BaseHref}'>
                Explore<br>
                Otago<br>
                Polytechnic
            </a></h2>
        </section>
        <% if $GetFooterLinks %><% loop $GetFooterLinks %>
        <div class='col<% if $Pos == 2 %> large-col<% end_if %><% if $Last %> last-col<% end_if %>'>
            <% loop $Blocks %>
            <ul>
                <li><h3><% if $Link %><a href="{$Link}" target="{$Target}"><% end_if %>{$Title}<% if $Link %></a><% end_if %></h3></li>
                <% loop $Links %>
                 <li><a href='{$Link}' target="{$Target}">{$Title}</a></li>
                <% end_loop %>
            </ul>
            <% end_loop %>
        </div>
        <% end_loop %><% end_if %>

    </section>
    <div class='bottom'>
        <section class='container addresses'>
            <% if $TelephoneInternational || $TelephoneNewZealand || $ContactEmail %>
            <aside class='large-col col'>
                <p>
                    <% if $TelephoneInternational %>International <a href='tel:{$TelephoneInternational}'>{$TelephoneInternational}</a><br><% end_if %>
                    <% if $TelephoneNewZealand %>New Zealand <a href='tet:{$TelephoneNewZealand}'>{$TelephoneNewZealand}</a><br><% end_if %>
                    <% if $TelephoneInternational %>Email <a href='mailto:{$ContactEmail}'>{$ContactEmail}</a><% end_if %>
                </p>
            </aside>
            <% end_if %>
            <% if $AddressCol1 %><address class="col">{$AddressCol1HTML}</address><% end_if %>
            <% if $AddressCol2 %><address class="col middle">{$AddressCol2HTML}</address><% end_if %>
            <% if $AddressCol3 %><address class="col">{$AddressCol3HTML}</address><% end_if %>
        </section>

        <section class="container creativecommons">
            <img src="themes/otp/images/cc.png" alt="Creative Commons" />
            <p>Except where otherwise noted, content on this site is licensed under a <a href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International license</a>.</p>
    </div>

    <
    <% end_with %>
</footer>