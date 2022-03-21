<% if $Tabs %>
<div class='tabbed-content'>
	<section class="tab-index container">
		<ul>
			<% loop $Tabs %>
				<li<% if $First %> class="active"<% end_if %> data-for="tab-{$ID}">{$Title}</li>
			<% end_loop %>
		</ul>
	</section>

	<% loop $Tabs %>
		<section class="tab-section tab-{$ID}<% if $First %> active<% end_if %>">
			<% loop $Blocks %>

			<div class="content-block {$Color}">
				<div class="container">
					<h4 class="title">{$Title}</h4>
				</div>
				<% if $Items %>
				<ul class="itemList accordion-c">
					<% loop $Items %>
					<li class="checkable">
						<h2 class='title-c'><a href='#'><span class="icon icon-tick"></span>{$Title}</a></h2>

						<div class='accordion-item'>
							<div class="left-content-wrapper">
								<div class="element-content-generic left-content">
									<div class="content-padder">
										{$Content}
									</div>
								</div>
								
								<div class="right-content element">
									<% include MiniContactBlock %>
								</div>
							</div>
						</div>
					</li>
					<% end_loop %>
				</ul>
				<% end_if %>
			</div>
			<% end_loop %>
		</section>
	<% end_loop %>
</div>
<% end_if %>