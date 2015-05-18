<div class='way-finder packery clearThis'>
    <% if $Filters %>
    <nav class='col tile'>
        <% if not $HideTitle %><h3>{$Title}</h3><% end_if %>
        <ul>
            <% loop $OrderedFilters %>
            <li><a href='{$Link}' target="{$Target}">{$Title}<span class='goto'>&nbsp;</span></a></li>
            <% end_loop %>
        </ul>
    </nav>
    <% end_if %>

    <% loop $OrderedItems %>
        $Render
    <% end_loop %>
</div>
