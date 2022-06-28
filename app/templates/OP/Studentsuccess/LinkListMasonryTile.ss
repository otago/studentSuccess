<script src="/themes/otp/js/thirdparty/jquery.js" type="text/javascript"></script>
<div class='tile-c list-menu tile fixed has-padder'>
	<div class="padder">
    	<article>
    	    <h3>{$Title}</h3>
    	    <ul>
    	        <% loop $Links %>
    	            <li><a <% if Elements %>href='#{$ID}' data-show-items="[<% loop Elements %>$ID<% if not Last %>,<% end_if %><% end_loop %>]" class="searchf" id="link{$ID}" <% else %>href='{$Link}' target="{$Target}"<% end_if %>>{$Title}<span class='icon icon-arrow'>&nbsp;</span></a></li>
    	        <% end_loop %>
    	    </ul>
    	</article>
	</div>
	<% if $MasonryContent.ShowContacts %>
		<% with $MasonryContent %>
			<% if $HasContactableDetails %>
    			<div class='content-tile contact-tile'>
        		<%---	<% if $ContactBoxTitle %><h3>{$ContactBoxTitle}</h3><% end_if %>
        			<% if $ContactBoxContent %><p class='contact'>{$ContactBoxContent}</p><% end_if %>
        			<p class='lines'>
            			<% if $ContactBoxPhone %><a href='tel:{$ContactBoxPhone}'><span class='icon icon-phone'></span>{$ContactBoxPhone}</a><% end_if %>
            			<% if $ContactBoxEmail %><a href='mailto:{$ContactBoxEmail}'><span class='icon icon-mail'></span>{$ContactBoxEmail}</a><% end_if %>
        			</p>---%>
					<% include OTPContact %>
    			</div>

			<% else %>
    			<% with $SiteConfig %>
        			<div class='content-tile contact-tile OTPLinkList' style="width:100%; margin-left: -10px; " >
         			<% include OTPContact %>
        			</div>
    			<% end_with %>
			<% end_if %>
		<% end_with %>
	<% end_if %>
</div>
<script>
	(function($){



		$( document ).ready(function() {
			var urlParams = new URLSearchParams(window.location.search);
			$("#link"+urlParams.get('p')).click();
		});


	})(jQuery);

	$( document ).ready(function() {
		var urlParams = new URLSearchParams(window.location.search);
		$("#link"+urlParams.get('p')).click();
	});

</script>