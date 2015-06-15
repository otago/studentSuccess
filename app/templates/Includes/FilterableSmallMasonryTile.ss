
<% if $Link %>
    <a href='$CounterLink' target="{$Target}" class="tile tile-c half block-anchor" data-subject="{$Subject}" data-sort="{$SortOrder}" data-views="{$Views}" data-title="{$Title}">
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