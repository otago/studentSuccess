<section class="links-content {$Color} <% if $Image %>has-image<% end_if %>">
	<div class="component-alignment boxed-element">
		<div class='links-block'>
			<div class="col left">
				<span class="icon icon-external-link"></span>
				<% if not HideTitle %>
					<h3>{$Title}</h3>
				<% end_if %>

				$DisplayContent

				<% if $OrderedLinks %>
					<ul>
						<% loop $OrderedLinks %>
							<li>
								<a href="{$Link}" <% if Target %>target="{$Target}"<% end_if %>>{$Title} <span class='icon icon-arrow'><span></a>
							</li>
						<% end_loop %>
					</ul>
				<% end_if %>
				<% if $hasLink %>
					<a class="button-link" href='{$hasLink}' target="{$Target}" >{$Title}</a>
				<% end_if %>
			</div>

			<% if $Image %>
				<div class="col image hide_on_mobile">
					$Image
				</div>
			<% end_if %>
		</div>
	</div>
</section>
