<% with $Widget %> 
<div class='tile-c list-menu tile fixed has-padder'>
	<div class="padder">
    	<article>
    	    <h3>{$Title}</h3>
    	    <ul>
    	        <% loop $Links %>
    	            <li><a <% if Elements %>href='#' data-show-items="[<% loop Elements %>$ID<% if not Last %>,<% end_if %><% end_loop %>]" class="searchf" <% else %>href='{$Link}' target="{$Target}"<% end_if %>>{$Title}<span class='icon icon-arrow'>&nbsp;</span></a></li>
    	        <% end_loop %>
    	    </ul>
    	</article>
	</div>
	<% if $MasonryContent.ShowContacts %>
		<% with $MasonryContent %>
			<% if $HasContactableDetails %>
    			<div class='content-tile contact-tile'>
        			<% if $ContactBoxTitle %><h3>{$ContactBoxTitle}</h3><% end_if %>
        			<% if $ContactBoxContent %><p class='contact'>{$ContactBoxContent}</p><% end_if %>
        			<p class='lines'>
            			<% if $ContactBoxPhone %><a href='tel:{$ContactBoxPhone}'><span class='icon icon-phone'></span>{$ContactBoxPhone}</a><% end_if %>
            			<% if $ContactBoxEmail %><a href='mailto:{$ContactBoxEmail}'><span class='icon icon-mail'></span>{$ContactBoxEmail}</a><% end_if %>
        			</p>
    			</div>
			<% else %>
    			<% with $SiteConfig %>
        			<div class='content-tile contact-tile'>
         				<% if $ContactBoxTitle %><h3>{$ContactBoxTitle}</h3><% end_if %>
          				<% if $ContactBoxContent %><p class='contact'>{$ContactBoxContent}</p><% end_if %>
            			<p class='lines'>
                			<% if $ContactBoxPhone %><a href='tel:{$ContactBoxPhone}'><span class='icon icon-phone'></span>{$ContactBoxPhone}</a><% end_if %>
                			<% if $ContactBoxEmail %><a href='mailto:{$ContactBoxEmail}'><span class='icon icon-mail'></span>{$ContactBoxEmail}</a><% end_if %>
            			</p>
        			</div>
    			<% end_with %>
			<% end_if %>
		<% end_with %>
	<% end_if %>
</div>
<% end_with %>