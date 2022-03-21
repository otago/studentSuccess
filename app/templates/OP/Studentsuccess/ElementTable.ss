<% with $Widget %> 
<div class="element-content-generic left-content tableelement">
	$ProcessedHTML

	<% if ReadMoreContent %>
		<p><a href="#" class="togglereadmore hide-nojs"><% if ReadMoreTitle %>$ReadMoreTitle<% else %>Read More<% end_if %></a></p>

		<div class="readmore-content hide-js">
			$ReadMoreContent
		</div>
	<% end_if %>
</div>
<% end_with %>