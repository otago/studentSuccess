<section class='cta {$Color} clear-this <% if $Image %>has-image<% end_if %>'>
	<div class="component-alignment boxed-element">
		<div class="col left">
			<% if $Icon %>
				<span class='icon $Icon'></span>
			<% end_if %>
			<% if $DisplayTitle %>
				<h3>{$DisplayTitle}</h3>
			<% end_if %>
			<% if $CTAContent %>
				<p>
					{$CTAContent}
				</p>
			<% end_if %>
			<% if $Link && $ButtonText%>
			<a href='{$Link}' target={$Target}>{$ButtonText}</a>
			<% end_if %>
		</div>

		<% if $Image %>
			<div class="col image hide_on_mobile">
				$Image
			</div>
		<% end_if %>
	</div>
</section>