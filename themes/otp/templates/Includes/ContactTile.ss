<% with $SiteConfig %>
    <div class='tile fixed fixed-right tile-c content-tile contact-tile right'>
        <% if $ContactBoxTitle %><h3>{$ContactBoxTitle}</h3><% end_if %>
        <% if $ContactBoxContent %><p class='contact'>{$ContactBoxContent}</p><% end_if %>
        <p class='lines'>
            <% if $ContactBoxPhone %><a href='tel:{$ContactBoxPhone}'><span class='icon icon-phone'></span>{$ContactBoxPhone}</a><% end_if %>
            <% if $ContactBoxEmail %><a href='mailto:{$ContactBoxEmail}'><span class='icon icon-mail'></span>{$ContactBoxEmail}</a><% end_if %>
        </p>
    </div>
<% end_with %>