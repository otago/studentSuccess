<div class="element-content-generic left-content tableelement">
	$HTML

	<% if ReadMoreContent %>
		<p><a href="#" class="togglereadmore hide-nojs"><% if ReadMoreTitle %>$ReadMoreTitle<% else %>Read More<% end_if %></a></p>

		<div class="readmore-content hide-js">
			$ReadMoreContent
		</div>
	<% end_if %>
</div>
