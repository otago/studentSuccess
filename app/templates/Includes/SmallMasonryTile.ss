<% if $Link %>
    <a href='$Link' <% if not OpenInModal %>target="{$Target}"<% end_if %> class="tile tile-c half block-anchor <% if OpenInModal %>fancybox-link<% end_if %>" data-fancybox-type="ajax">
<% else %>
    <div class='tile tile-c half '>
<% end_if %>

    <h3>{$Title}</h3>

    <% if $LinkButton %>
        <% include SecondaryLink %>
    <% end_if %>

<% if $Link %>
    </a>
<% else %>
    </div>
<% end_if %>