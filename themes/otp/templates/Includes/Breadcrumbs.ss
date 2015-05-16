<% if $BreadCrumbPages %>
<div class='breadcrumbs'>
    <ul>
        <% loop $BreadCrumbPages %>
            <% if $Last %>
                <li><a href='{$Link}'>{$MenuTitle.XML}</a></li>
            <% else %>
                <li><a href='{$Link}'>{$MenuTitle.XML} <span class='icon icon-arrow'></span></a></li>
            <% end_if %>
        <% end_loop %>
    </ul>
</div>
<% end_if %>