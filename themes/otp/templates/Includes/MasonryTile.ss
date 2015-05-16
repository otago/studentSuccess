<div class='tile tile-c content-tile'>
    <h3>
        <% if $Link %><a href='{$Link}' target="{$Target}"><% end_if %>
        {$Title}
        <% if $Link %><span class='icon icon-arrow'></span></a><% end_if %>
    </h3>
    <% if $Content %><p>{$Content}</p><% end_if %>
</div>