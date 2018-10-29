<% with $Widget %> 
<div class="component-alignment wide-boxed-element tightentop">
	<div class="massSearch"> <% include  search %> </div>
	<%--- <form class='filter-form form-{$ID}'>
		<div class='filters'>
			<fieldset>
				<div class='input'>
					<input class="keywords" placeholder='{$SearchFieldDefaultText}'>
				</div>

				<div class='clear'></div>
			</fieldset>

			<div class='actions'>
				<button class='search icon-search icon'></button>
			</div>
		</div>

		<div class='sort-by'>
			<div class='options'>
				<label>Sort by:</label>

				<div class='option-holder'>
					<select class="sort-filter">
						<option value='views'>Most viewed</option>
						<option value='title'>Alphabetical</option>
					</select>
				</div>
			</div>

			<div class='clear'></div>
		</div>
	</form>---%>

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