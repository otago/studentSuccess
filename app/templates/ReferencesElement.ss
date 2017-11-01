<div class="element-content-generic left-content accordion-item-content init">
    <div class="content-padder what" style="padding-left: 4em; text-indent: -4em;">
        <% if $Widget %>
            <% with $Widget %> 
            {$reference1} <i>{$referenceItalics}</i> {$reference2} <a href="$link">$link</a>
            <% end_with %>
        <% else %>
         {$reference1} <i>{$referenceItalics}</i> {$reference2} <a href="$link">$link</a>
        <% end_if %>
    </div>
</div>