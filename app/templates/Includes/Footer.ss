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
                   
                    <% if $TelephoneInternational %>Your suggestions are welcome, please email <a href='mailto:{$ContactEmail}'>{$ContactEmail}</a><% end_if %>
                </p>
            </aside>
            <% end_if %>
            <% if $AddressCol1 %><address class="col">{$AddressCol1}</address><% end_if %>
            <% if $AddressCol2 %><address class="col middle">{$AddressCol2}</address><% end_if %>
            <% if $AddressCol3 %><address class="col">{$AddressCol3}</address><% end_if %>
        </section>

        <section class="container creativecommons">
            {$CreativeCommonsLicenceImage}
            {$CreativeCommonsLicence}
        </section>
    </div>
    <% end_with %>
</footer>