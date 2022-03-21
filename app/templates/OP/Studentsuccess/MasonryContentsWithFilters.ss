<% with $Widget %> 
<div class="component-alignment wide-boxed-element tightentop">
    <div class="massSearch"> <% include  search %> </div>

	<div class='masonry-content masonry-filter clear-this'>
		<div class='packery filters' data-filterform="form-{$ID}">
			<div class='tile tile-c half width-c'></div>
			<% loop $Tiles %>
				$Render
			<% end_loop %>
		</div>
	</div>
</div>
<% end_with %>