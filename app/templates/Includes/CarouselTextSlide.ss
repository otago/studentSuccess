<li class='title-content'>
    <div class='wrapper'>
        <div class='holder'>
            <article>
                <% if $Title %><h2>{$Title}</h2><% end_if %>
                <% if $Content %>
                	<div class="content">
                		$Content
                	</div>
                <% end_if %>
            </article>
        </div>
    </div>
</li>