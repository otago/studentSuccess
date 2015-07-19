<% include MiniHero %>

<div class='page-contents clear-this'>
    <% include Breadcrumbs %>
    
    <div class="elements-holder modal-content">
        <% include PageIntro %>

        <% if CheckForm %>
        <div class="element-content-generic left-content checkform">
			$CheckForm
		</div>
		<% end_if %>

        <% if $CorrectBlocks %>
			<div class='tabbed-content'>
				<section class="tab-section active">
					<% loop $CorrectBlocks %>

						<div class="content-block {$Color}">
							<div class="container">
								<h4 class="title">{$Title}</h4>
							</div>

							
							<ul class="itemList accordion-c">
								<% if $Items %>
									<% loop $Items %>
									<li class="checkable">
										<h2 class='title-c'><a href='#'><span class="icon icon-tick" data-item="$ID"></span>{$Title}</a></h2>

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
								<% end_if %>
							</ul>
						</div>
					<% end_loop %>
				</section>
			</div>
		<% end_if %>

		<% if not CheckForm %>
			<div class="element-content-generic left-content">
				<p><a href="$Link(reset)" class="backaction">Back</a></p>
			</div>
		<% end_if %>
	</div>
</div>