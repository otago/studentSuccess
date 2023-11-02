<div class='accordion-c'>
	<% loop $Items %>
		<h2 class='title-c title-color-Blue'><a id="a$ID" href="#a$ID">{$Title}</a></h2>

		<div class='accordion-item'>
			<% if ListDescription %>
				<div class='element-content-generic left-content accordion-item-content'>
					<div class="content-padder">
						$ListDescription
					</div>
				</div>
			<% end_if %>


        <% if ShouldHaveWrapper %><div class="left-content-wrapper"><% end_if %>
            $Me
        <% if ShouldCloseWrapper %></div><% end_if %>


		</div>
	<% end_loop %>
</div>
