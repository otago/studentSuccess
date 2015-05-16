<section class='case-study-holder'>
    <div class='case-study {$Color}'>
        <div class="component-alignment">
            <div class='left<% if not $Image %> no-image<% end_if %>'>
                <% if $Image %>
                    {$Image.Pure}
                <% end_if %>
                <span class='icon icon-apostrophe'></span>
                <% if $Summary %>
                <p>
                    {$Summary}
                </p>
                <% end_if %>
            </div>
            <div class='right'>
                {$CaseStudyContent}
            </div>

            <div class='clear'>&nbsp;</div>
        </div>
    </div>
</section>