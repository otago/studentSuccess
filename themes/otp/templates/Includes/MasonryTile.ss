<% if $Link %>
    <a href='{$Link}' target="{$Target}" class='block-anchor tile tile-c content-tile'>
<% else %>
    <div class='tile tile-c content-tile'>
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