<div class="elements-holder">
    
	<div class="element-content-generic left-content full-width">
	<h1>{$SearchResults.count} results for "{$SearchText}"</h1>
	<div class="result-list">
            <% if $SearchResults %>
                <ul>
                    <% loop $SearchResults %>
                        <li>
                            <span class="link"><a href="{$Link}">{$Title}</a></span>
                        </li>
                    <% end_loop %>
                </ul>
            <% end_if %>
        </div>
</div>

</div>