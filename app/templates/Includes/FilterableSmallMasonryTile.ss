
<% if $Link %>
    <a href='$CounterLink' <% if not OpenInModal %>target="{$Target}"<% end_if %> class="tile tile-c half block-anchor <% if OpenInModal %>fancybox-link<% end_if %>" data-fancybox-type="ajax" data-subject="{$Subject}" data-sort="{$SortOrder}" data-views="{$Views}" data-title="{$Title}" >
<% else %>
    <div class='tile tile-c half' data-subject="{$Subject}" data-sort="{$SortOrder}" data-views="{$Views}" data-title="{$Title}" >
<% end_if %>


    <h3>{$Title}</h3>
        <% if $Link && $LinkButton %>
        <p class='separator-link'>
            <% include PencilIcon %> $LinkButton
        </p>
        <% end_if %>


<% if $Link %>
    </a>
<% else %>
    </div>
<% end_if %>