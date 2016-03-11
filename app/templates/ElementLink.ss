<% with $Widget %> 
<% if $InternalLink %> 
<div class="component-alignment boxed-element left-content internal_link ">
	<div class="content-padder">
  		<a href='{$InternalLink.Link}' class='feature-link <% if OpenInModal %>fancybox-link<% end_if %>' data-fancybox-type="ajax" <% if $NewWindow %>target="_blank" <% end_if %>><strong>$LinkText</strong>
    	$LinkDescription
    	</a>
    </div>
</div>
<% else %> 
<div class="component-alignment boxed-element left-content external_link ">
	<div class="content-padder">
		<a class="feature-external-link" href="$LinkURL" <% if NewWindow %>target="_blank"<% end_if %>><strong><% if LinkText %>$LinkText<% else %>$LinkURL<% end_if %></strong>
		$LinkDescription
		</a>
	</div>
</div>
<% end_if %>

<% end_with %>