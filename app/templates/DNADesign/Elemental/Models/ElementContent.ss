<div class="element-content-generic left-content <% if FullWidth %> full-width<% end_if %>">
    <div class="content-padder ">
        $ProcessedHTML

        <% if ReadMoreContent ||  $Reference %>
            <p><a href="#" class="togglereadmore hide-nojs"><% if ReadMoreTitle %>$ReadMoreTitle<% else %>Read
                More<% end_if %></a></p>

            <div class="readmore-content hide-js">
                $ReadMoreContent
                <% loop $Reference %>
                    <% include ReferencesElementGeneral %>
                <% end_loop %>
            </div>
        <% end_if %>

    </div>
</div>

