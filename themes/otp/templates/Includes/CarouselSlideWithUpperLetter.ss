<div class='wrapper'>
	<div class='holder'>
		<% if $Title %>
			<div class='slide-title'>
				<h3 style="width: {$Width}%; left: {$Left}%;">
                    <span class="bar"></span>
                    <span class='icon icon-head-arrow'></span>{$Title}
                </h3>
			</div>
		<% end_if %>
		<% if $Content %>
			<div class='slide-intro'>
				<p>{$Content}</p>
			</div>
		<% end_if %>
	</div>
</div>
