<div class='tile tile-c image-tile overflow-content'>
    <% if $Link %><a href='{$Link}' target="{$Target}" class="image-link"><% end_if %>
    {$Image}
    <% if $Link %></a><% end_if %>
    <% if $HideTitle == 0 || $Content %>
        <article>
            <% if not $HideTitle %><h3>
                <% if $Link %><a href='{$Link}' target="{$Target}"><% end_if %>
                {$Title}
                <% if $Link %><span class='icon icon-arrow'></span></a><% end_if %>
            </h3><% end_if %>

            <% if $Content %><p>{$Content}</p><% end_if %>
        </article>
    <% end_if %>
</div>