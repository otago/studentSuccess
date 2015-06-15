<% include MiniHero %>

<div class='page-contents clear-this'>
    <% include Breadcrumbs %>
    
    <div class="elements-holder modal-content">
        <% include PageIntro %>

        $ElementArea
    </div>

    <% if ClassName == "LandingPage" %>
    <% else_if ClassName == "LandingSearchPage" %>
    <% else %>
    	<% include WasThisHelpful %>
    <% end_if %>
</div>