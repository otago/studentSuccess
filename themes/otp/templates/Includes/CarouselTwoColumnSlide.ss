<li class='title-content-compact'>
    <div class='wrapper'>
        <div class='holder'>
            <div class='left'>
                <% if $TitlePrefix %><h3>{$TitlePrefix}</h3><% end_if %>
                <% if $Title %><h2>{$Title}</h2><% end_if %>
                <% if $Content %><p>
                    {$Content}
                </p>
                <% end_if %>
            </div>
            <div class='right'>
                <% if $RightColTitle %>
                <h3><span class='icon icon-head-arrow'></span>{$RightColTitle}</h3>
                <% end_if %>
                <% if $RightColContent %><p>{$RightColContent}</p><% end_if %>
            </div>
        </div>
    </div>
</li>