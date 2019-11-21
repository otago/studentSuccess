<% include MiniHero %>

<div class='page-contents clear-this'>
	<% include Breadcrumbs %>

	<div class="elements-holder modal-content">
		<% include PageIntro %>

		$ElementArea
	</div>


</div>
	<% if IFrameURL %>
		<span id="Iframepage-loadding" style="display: none;">
			<%t IframePage.Loading "Loading content..." %>
		</span>
		<div class="nonvisual-indicator" style="position: absolute; overflow: hidden; clip: rect(0 0 0 0); height: 1px; width: 1px; margin: -1px; padding: 0; border: 0;">
			<%t IframePage.ExternalNote "Please note the following section of content is possibly being delivered from an external source (IFRAME in HTML terms), and may present unusual experiences for screen readers." %>
		</div>
		<iframe id="Iframepage-iframe" style="$Style ;border: none;" src="$IFrameURL" class="$Class">$AlternateContent</iframe>
	<% end_if %>
	$BottomContent
</div>
</div>


<% if ClassName == "LandingPage" %>
<% else_if ClassName == "LandingSearchPage" %>
<% else %>
	<% include WasThisHelpful %>
<% end_if %>