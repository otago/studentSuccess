<% if $Link %>
    <a href='$Link' target="{$Target}" class="tile tile-c half block-anchor">
<% else %>
    <div class='tile tile-c half '>
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