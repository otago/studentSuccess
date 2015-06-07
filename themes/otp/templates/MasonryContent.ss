<div class="component-alignment boxed-element">
	<div class='masonry-content'>
		<div class='packery'>
			<div class='tile tile-c half width-c'></div>
				<% loop $Tiles %>
					$Render
				<% end_loop %>
				
				<% if $ShowContacts %>
					<% include ContactTile %>
				<% end_if %>
			</div>
		</div>
	</div>
</div>