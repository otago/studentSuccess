<% include MiniHero %>

<div class='page-contents clear-this'>
	<% include Breadcrumbs %>
	
	<div class="elements-holder">
		<section class='page-intro'>
			<article>
				<% include  search %>
				<h1 class='title'>Search Results</h1>
				
				<p>{$SearchResults.count} results for "{$SearchText}"</p>
			</article>
		</section>

		<div class="element-content-generic left-content">

			<div class="content-padder">
				<div class="result-list">
					<% if $SearchResults %>
						<% loop $SearchResults %>
							<h2><a href="{$Link}">{$Title}</a></h2>
							<p><small>$Breadcrumbs</small></p>

							<p>$Content.Summary</p>
							
							<hr />
						<% end_loop %>
					<% end_if %>
				</div>
			</div>
		</div>
	</div>


	<% include WasThisHelpful %>
</div>