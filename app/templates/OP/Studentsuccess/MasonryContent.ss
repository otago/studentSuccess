<div class="component-alignment wide-boxed-element">
    <div class="massSearch $ExtraClass" > <% include  search %> </div>
	<div class='masonry-content masonry-basic'>
		<div class='packery'>
			<div class='tile tile-c half width-c'></div>
				<% loop $Tiles %>
					$Render
				<% end_loop %>
				
				<% if $ShowContacts %>
					<% include ContactTile ExtraClass="basic" %>
				<% end_if %>
			</div>
		</div>
	</div>
</div>
