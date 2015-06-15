<% if $BreadCrumbPages %>
<div class='breadcrumbs component-alignment boxed-element clear-this'>
	<% if ClassName == LandingPage %>
	<% else_if ClassName == LandingSearchPage %>
	<% else %>
    	<ul>
        	<% loop $BreadCrumbPages %>
        	    <% if $Last %>
        	        <li><a href='{$Link}'>{$MenuTitle.XML}</a></li>
        	    <% else %>
        	        <li><a href='{$Link}'>{$MenuTitle.XML} <span class='icon icon-arrow'></span></a></li>
        	    <% end_if %>
        	<% end_loop %>
    	</ul>
    <% end_if %>
</div>
<% end_if %>