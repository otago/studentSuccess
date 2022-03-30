<% if $Widget %>
<% with $Widget %> 
<figure class="right-content element">
	<% if InternalLink %>
		<a class="internal_link" href="$InternalLink.Link" <% if NewWindow %>target="_blank"<% end_if %>>
	<% end_if %>

    {$Image.Pure}
    <% if $Caption %>
        <figcaption>
            {$Caption}
        </figcaption>
    <% end_if %>

    <% if InternalLink %>
    	</a>
    <% end_if %>
</figure>
<% end_with %>
<% else %>

<figure class="right-content element">
	<% if InternalLink %>
		<a class="internal_link" href="$InternalLink.Link" <% if NewWindow %>target="_blank"<% end_if %>>
	<% end_if %>

    {$Image.Pure}
    <% if $Caption %>
        <figcaption>
            {$Caption}
        </figcaption>
    <% end_if %>

    <% if InternalLink %>
    	</a>
    <% end_if %>
</figure>
<% end_if %>