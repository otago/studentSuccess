<section class="links-content {$Color}">
	<div class="component-alignment boxed-element">
    	<div class='links-block'>
	        <% if $Image %>
	        <div class="col image">
	                $Image.Pure
	        </div>
	        <% end_if %>
	        <div class="col left">
	            <span class="icon {$Icon}"></span>
	            <h3>{$DisplayTitle}</h3>
	            <% if $OrderedLinks %>
	                <ul>
	                    <% loop $OrderedLinks %>
	                        <li>
	                            <a href="{$Link}" target="_blank">{$Title} <span class='icon icon-arrow'><span></a>
	                        </li>
	                    <% end_loop %>
	                </ul>
	            <% end_if %>
				<% if $Link %>
					<a class="button-link" href='{$Link}' target="{$Target}" >{$DisplayTitle}</a>
				<% end_if %>
	        </div>
	    </div>
	</div>
</section>