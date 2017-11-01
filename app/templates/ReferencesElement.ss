<div class="element-content-generic left-content accordion-item-content init">
    <div class="content-padder referenceindenting" >
        <% if $Widget %>
            <% with $Widget %> 
                {$reference1} <i>{$referenceItalics}</i> {$reference2} <a target="_blank" href="$link">$link</a>
            <% end_with %>
        <% else %>
            {$reference1} <i>{$referenceItalics}</i> {$reference2} <a  target="_blank" href="$link">$link</a>
        <% end_if %>
    </div>
</div>