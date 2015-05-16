<div class='way-finder packery'>
    <% if $Filters %>
    <nav class='col tile'>
        <% if $FiltersTitle %><h3>{$FiltersTitle}</h3><% end_if %>
        <ul>
            <% loop $OrderedFilters %>
            <li><a href='{$Link}' target="{$Target}">{$Title}<span class='goto'>&nbsp;</span></a></li>
            <% end_loop %>
        </ul>
    </nav>
    <% end_if %>

    <% loop $Items %>
        $Render
    <% end_loop %>
</div>
