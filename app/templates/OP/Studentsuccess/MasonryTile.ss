<% if $Link %>
    <a href='{$Link}' <% if not OpenInModal %>target="{$Target}"<% end_if %> class='block-anchor tile tile-c content-tile <% if OpenInModal %>fancybox-link<% end_if %>' data-fancybox-type="ajax">
<% else %>
    <div class='tile tile-c content-tile'>
<% end_if %>
	<div class="height">
    	<h3>
        	{$Title}
        	<% if $Link %><span class='icon icon-arrow'></span><% end_if %>
    	</h3>
    	<% if $Content %><p>{$Content}</p><% end_if %>
    </div>
<% if $Link %>
    </a>
<% else %>
    </div>
<% end_if %>