<picture class="image-load {$CSSClass}"<% if $ID %> id="{$ID}"<% end_if %> data-width="{$Width}" data-height="{$Height}">
    <!--[if IE 9]><video style="display: none;"><![endif]-->
    <% if $Sizes %><% loop $Sizes %>
        <source srcset="{$Image.URLWithSuffix}" media="(max-width: {$Size}px)">
    <% end_loop %><% end_if %>
    <!--[if IE 9]></video><![endif]-->
    <img srcset="{$URLWithSuffix}" alt="{$Alt}">
</picture>