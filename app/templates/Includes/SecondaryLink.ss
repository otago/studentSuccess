<div class='separator-link <% if SecondaryTarget == "_modal" %>fancybox-link<% end_if %>' href='<% if SecondaryLinkURL %>$SecondaryLinkURL<% else %>$SecondaryPageLink.AbsoluteLink<% end_if %>' <% if SecondaryTarget == "_modal" %>data-fancybox-type="ajax"<% else %> data-target="{$SecondaryTarget}"<% end_if %>>
    <div class="marginPencilIcon"><% include PencilIcon %></div><div class="linkbuttonText">$LinkButton</div>
</div>
