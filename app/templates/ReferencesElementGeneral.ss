<div class="element-content-generic   init">
    <div class="content-padd4er referenceindenting" >
        <% if $Widget %>
            <% with $Widget %> 
                {$reference1} <i>{$referenceItalics}</i> {$reference2} <a target="_blank" href="$link">$link</a>
            <% end_with %>
        <% else %>
            {$reference1} <i>{$referenceItalics}</i> {$reference2} <a target="_blank" href="$link">$link</a>
        <% end_if %>
    </div>
</div>