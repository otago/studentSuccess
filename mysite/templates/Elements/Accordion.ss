<div class='accordion-c'>
    <div class="component-alignment">
    <% loop $Items %>
        <h2 class='title-c'><a href='#'>{$Title}</a></h2>
        <div class='accordion-item'>
			<div class='accordion-item-content'>
            	$Content
			</div>	
        </div>
    <% end_loop %>
    </div>
</div>