<div class="element-content-generic left-content accordion-item-content init">
    <div class="content-padder" style="padding-left: 4em; text-indent: -4em;">
<% if $Widget %>
    <% with $Widget %> 
    {$reference} <a href="$link">$link</a>
    <% end_with %>
<% else %>
 {$reference} <a href="$link">$link</a>
<% end_if %>

</div>
    </div>