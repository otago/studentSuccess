<% if $HeroImage %>
<section class='hero bg-image clear-this' data-top='header.main'>
	<div class="grad">
	    <div class='contents'>
			<div class="homepage">
			<% if $HeroTitle %><h2>{$HeroTitleHTML}</h2><% end_if %></div>
	        <% if $HeroContent %><p>{$HeroContentHTML}</p><% end_if %>
 			<% include  search %>
	        <% if $HeroLink && $HeroLinkText %>
	        <a href='$HeroLink' target="{$HeroLinkTarget}">A call to action</a>
	        <% end_if %>

	    </div>
	 </div>
    {$HeroImage}
</section>
<% end_if %>

$ElementArea