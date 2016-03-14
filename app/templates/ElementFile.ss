<% with $Widget %> 
<div class="component-alignment boxed-element left-content external_link">
	<div class="content-padder">
		<p>
    		<a href='{$File.Link}' class='feature-download' <% if ForceDownload %>download="$File.Link"<% else %>target="_blank"<% end_if %>><strong>$Title</strong>$FileDescription</a>
		</p>
	</div>
</div>
<% end_with %>