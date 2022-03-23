<% if $HeroImage %>
<section class='hero bg-image clear-this' data-top='header.main'>
	<div class="grad">
	    <div class='contents'>
	        <% if $HeroTitle %><h2>{$HeroTitle}</h2><% end_if %>
	        <% if $HeroContent %><p>{$HeroContent}</p><% end_if %>
			<div class="homepage"> <% include  search %></div>
	        <% if $HeroLink && $HeroLinkText %>
	        <a href='$HeroLink' target="{$HeroLinkTarget}">A call to action</a>
	        <% end_if %>

	    </div>
	 </div>
    {$HeroImage}
</section>
<% end_if %>

$ElementArea
$Content

<!DOCTYPE html>

<head>

</head>
<body class="template_{$ClassName}">


</body>
</html>