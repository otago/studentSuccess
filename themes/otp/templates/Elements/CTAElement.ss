<section class='cta {$Color}'>
    <div class="component-alignment">
        <% if $Image %>
        <picture class='bg-image full-height'>
            {$Image}
        </picture>
        <% end_if %>
        <article>
            <div class='wrapper'>
                <% if $Icon %>
                    <span class='icon $Icon'></span>
                <% end_if %>
                <% if $DisplayTitle %>
                    <h3>{$DisplayTitle}</h3>
                <% end_if %>
                <% if $CTAContent %>
                    <p>
                        {$CTAContent}
                    </p>
                <% end_if %>
                <% if $Link && $ButtonText%>
                <a href='{$Link}'>{$ButtonText}</a>
                <% end_if %>
            </div>
        </article>
    </div>
</section>