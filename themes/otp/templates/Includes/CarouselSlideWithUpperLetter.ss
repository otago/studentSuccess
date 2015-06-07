<div class='wrapper'>
	<div class='holder'>
		<% if $Title %>
			<div class='slide-title'>
				<h3 class="title" style="width: {$Width}%; left: {$Left}%;">
                    <span class="bar"></span>
                    <span class='icon icon-head-arrow'></span>
					<span>{$Title}</span>
                </h3>
			</div>
		<% end_if %>
		<% if $Content %>
			<div class='slide-intro'>
				<h3 class='title showInMobile'>
                	<span class='icon icon-head-arrow'></span>{$Title}
            	</h3>

            	<div class="content">
                	$Content
                </div>
			</div>
		<% end_if %>
	</div>
</div>