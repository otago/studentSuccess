<% if $HeroImage %>
<section class='hero bg-image clear-this' data-top='header.main'>
	<div class="grad">
	    <div class='contents'>
	        <% if $HeroTitle %><h2>{$HeroTitleHTML}</h2><% end_if %>
	        <% if $HeroContent %><p>{$HeroContentHTML}</p><% end_if %>

	        <% if $HeroLink && $HeroLinkText %>
	        <a href='$HeroLink' target="{$HeroLinkTarget}">A call to action</a>
	        <% end_if %>

	    </div>
	 </div>
    {$HeroImage}
</section>
<% end_if %>

$ElementArea