<% if $HasContactableDetails %>
    <% if $ContactBoxTitle %><h4>{$ContactBoxTitle}</h4><% end_if %>
    <% if $ContactBoxContent %><p class='small-text'>{$ContactBoxContent}</p><% end_if %>
    <p class='small-text'>
        <% if $ContactBoxPhone %><a href='tel:{$ContactBoxPhone}'><span class='icon icon-phone'></span>{$ContactBoxPhone}</a><% end_if %>
        <% if $ContactBoxEmail %><a href='mailto:{$ContactBoxEmail}'><span class='icon icon-mail'></span>{$ContactBoxEmail}</a><% end_if %>
    </p>

<% else %>

    <% with $SiteConfig %>
        <% if $ContactBoxTitle %><h4>{$ContactBoxTitle}</h4><% end_if %>
        <% if $ContactBoxContent %><p class='small-text'>{$ContactBoxContent}</p><% end_if %>
        <p class='small-text'>
            <% if $ContactBoxPhone %><a href='tel:{$ContactBoxPhone}'><span class='icon icon-phone'></span>{$ContactBoxPhone}</a><% end_if %>
            <% if $ContactBoxEmail %><a href='mailto:{$ContactBoxEmail}'><span class='icon icon-mail'></span>{$ContactBoxEmail}</a><% end_if %>
        </p>
    <% end_with %>

<% end_if %>
