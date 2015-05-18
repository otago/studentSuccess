<div class='tile tile-c image-tile overflow-content' data-subject="{$Subject}" data-sort="{$SortOrder}" data-views="{$Views}" data-title="{$Title}">
    <% if $Link %><a href='{$CounterLink}' target="{$Target}" class="image-link"><% end_if %>
    {$Image}
    <% if $Link %></a><% end_if %>
    <% if $HideTitle == 0 || $Content %>
        <article>
            <% if not $HideTitle %><h3>
                <% if $Link %><a href='{$CounterLink}' target="{$Target}"><% end_if %>
                {$Title}
                <% if $Link %><span class='icon icon-arrow'></span></a><% end_if %>
            </h3><% end_if %>

            <% if $Content %><p>{$Content}</p><% end_if %>
        </article>
    <% end_if %>
</div>