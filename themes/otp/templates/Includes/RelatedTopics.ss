<% if $HasRelatedTopics %>
    <div class='related-topics'>


        <div class='masonry-content'>
            <h2 class='title'><% if $RelatedTopicsTitle %>{$RelatedTopicsTitle}<% else %>Related topics<% end_if %></h2>

            <div class='packery'>

                <% if $RelatedPages %>
                    <div class='tile tile-c fixed contact-left no-padding'>

                        <div class='tile-c list-menu'>
                            <article>
                                <ul>
                                    <% loop $RelatedPages %>
                                        <li><a href='{$Link}' target="{$Target}">{$Title}<span class='icon icon-arrow'>&nbsp;</span></a></li>
                                    <% end_loop %>
                                </ul>
                            </article>
                        </div>
                    </div>
                <% end_if %>

                <% if $ShowRelatedTopicsContacts %>
                    <% include ContactTile %>
                <% end_if %>

                <% if $RelatedBoxes %>
                    <% loop $RelatedBoxes %>
                        <div class='tile tile-c half '>
                            <% if $Link %><a href='$Link' target="{$Target}" class="block-anchor"><% end_if %>
                            <h3>{$Title}</h3>
                            <% if $Link %></a><% end_if %>
                            <% if $Link && $LinkButton%>
                                <p class='separator-link'>
                                    <a href='$Link'><% include PencilIcon %> $LinkButton</a>
                                </p>
                            <% end_if %>
                        </div>
                    <% end_loop %>
                <% end_if %>

            </div>

        </div>
    </div>
<% end_if %>