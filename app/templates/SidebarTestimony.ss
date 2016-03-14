<% if $Widget %>
<% with $Widget %> 
<article class='testimony-content right-content'>
	<span class="quotemark">“</span>
	
    <p class='text'>
        {$TestimonyContent}
    </p>
    <% if $TestimonyName %>
    <p class='testimony'>
        {$TestimonyName}
    </p>
    <% end_if %>
</article>
<% end_with %>
<% else %>
<article class='testimony-content right-content'>
	<span class="quotemark">“</span>
	
    <p class='text'>
        {$TestimonyContent}
    </p>
    <% if $TestimonyName %>
    <p class='testimony'>
        {$TestimonyName}
    </p>
    <% end_if %>
</article>
<% end_if %>
