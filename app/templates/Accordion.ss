<div class='accordion-c'>
	<% loop $Widget.Elements %>
		<h2 class='title-c title-color-{$AscentColour}'><a>{$Title}</a></h2>

		<div class='accordion-item'>
			<% if ListDescription %>
				<div class='element-content-generic left-content accordion-item-content'>
					<div class="content-padder">
						$ListDescription
					</div>
				</div>
			<% end_if %>

			<% if $Elements %>
				<% loop $Elements %>
					<% if ShouldHaveWrapper %><div class="left-content-wrapper"><% end_if %>
						$Content
					<% if ShouldCloseWrapper %></div><% end_if %>
				<% end_loop %>
			<% end_if %>
		</div>
	<% end_loop %>
</div