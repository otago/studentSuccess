<% if $Link %>
    <a class='tile tile-c content-tile' href='$CounterLink' data-subject="{$Subject}" data-sort="{$SortOrder}" data-views="{$Views}" data-title="{$Title}">
<% else %>
    <div class='tile tile-c content-tile' data-subject="{$Subject}" data-sort="{$SortOrder}" data-views="{$Views}" data-title="{$Title}">
<% end_if %>

    <h3>
        {$Title}
        <% if $Link %><span class='icon icon-arrow'></span><% end_if %>
    </h3>
    <% if $Content %><p>{$Content}</p><% end_if %>

<% if $Link %>
    </a>
<% else %>
    </div>
<% end_if %>
