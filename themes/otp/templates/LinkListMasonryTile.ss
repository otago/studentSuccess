<div class='tile-c list-menu tile'>
    <article>
        <h3>{$Title}</h3>
        <ul>
            <% loop $Links %>
                <li><a href='{$Link}' target="{$Target}">{$Title}<span class='icon icon-arrow'>&nbsp;</span></a></li>
            <% end_loop %>
        </ul>
    </article>
</div>