<% if $Widget %>
<% with $Widget %> 
<li class='title-content'>
    <div class='wrapper'>
        <div class='holder'>
            <article>
                <% if $Content %>
                	<div class="content">
                		$Content
                	</div>
                <% end_if %>
            </article>
        </div>
    </div>
</li>
<% end_with %>
<% else %>
<li class='title-content'>
    <div class='wrapper'>
        <div class='holder'>
            <article>
                <% if $Content %>
                	<div class="content">
                		$Content
                	</div>
                <% end_if %>
            </article>
        </div>
    </div>
</li>
<% end_if %>