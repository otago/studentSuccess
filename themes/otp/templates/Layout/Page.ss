<% include MiniHero %>

<div class='page-contents clear-this'>
    <% include Breadcrumbs %>
</div>

<div class="elements-holder">
	<div class="component-alignment">
    	<section class='page-intro'>
        	<article>
        	    <h1 class='title'>{$Title}</h1>
        	    <% if $Intro %>
        	        <p>{$Intro}</p>
        	    <% end_if %>
        	</article>
    	</section>
	</div>

    $ElementArea
</div>