<div class="glossary">
	<% include MiniHero %>

	<div class='page-contents'>
		<% include Breadcrumbs %>

		<% include PageIntro %>
		
		<div class="component-alignment wide-boxed-element tightentop">
			<form class='filter-form form-{$ID}'>
				<div class='filters'>
					<fieldset>
						<div class='input'>
							<input class="keywords" placeholder='{$SearchFieldDefaultText}'>
						</div>

						<div class='clear'></div>
					</fieldset>
					
					<div class='actions'>
						<button class='search icon-search icon'></button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<% if $GlossaryTypes %>
	<div class='tabbed-content clear-this'>
		<% if GlossaryTypes.Count > 1 %>
			<section class="tab-index container">
				<div class="container">
					<ul>
						<% loop $GlossaryTypes %>
						<li<% if $First %> class="active"<% end_if %> data-for="tab-{$ID}">{$Title}</li>
						<% end_loop %>
					</ul>
				</div>
			</section>
		<% end_if %>

		<% loop $GlossaryTypes %>
		<section class="tab-section tab-{$ID} <% if $First %>active<% end_if %>">
			<% if $Letters %>
			 <div class="content-block block1">
				<ul class="itemList accordion-c">
					<% loop $Letters %>
					<li class="glossary-letter">
						<h2 class='title-c'><a href='{$Letter}'>$Title</a></h2>

						<div class='accordion-item'>
							<% loop $Items %>
								<div class="left-content-wrapper">
									<div class="element-content-generic left-content">
										<article class="glossary-item">
											<h4>{$Title}</h4>
											
											<div class="small-text">
												{$Content}
											</div>	
										</article>
									</div>

									<% if $ShowContactInfo %>
										<div class="right-content element">
											<% include MiniContactBlock %>
										</div>
									<% end_if %>
								</div>
							<% end_loop %>
						</div>
					</li>
					<% end_loop %>
				</ul>
			</div>
			<% end_if %>
		</section>
		<% end_loop %>
	</div>
	<% end_if %>
</div>