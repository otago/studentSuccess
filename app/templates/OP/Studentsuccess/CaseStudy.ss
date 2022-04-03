<section class='case-study-holder clear-this'>
	<div class='case-study {$Color}'>
		<div class="component-alignment boxed-element">
			<div class='left<% if not $Image %> no-image<% end_if %>'>
				<% if $Image %>
					{$Image.Pure}
				<% end_if %>
				<span class="quotemark">“</span>
				<% if $SummaryQuote %>
				<p>
					{$SummaryQuote}
				</p>
				<% end_if %>
			</div>
			<div class='right'>			
				<% if not HideTitle %>
					<h2>$Title</h2>
				<% end_if %>

				{$CaseStudyContent}
			</div>

			<div class='clear'>&nbsp;</div>
		</div>
	</div>
</section>