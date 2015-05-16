<div class='hear-from-others'>
    <h2>{$DisplayTitle}</h2>

    <section>
        <div class='image'>
            <% if $VideoURL %>
                <a href="{$VideoURL}" class="video-image fancybox-link">{$Image.Pure}</a>
                <a href='{$VideoURL}' class='icon icon-play fancybox-link'></a>
            <% else %>
                {$Image.Pure}
            <% end_if %>
        </div>
        <article>
            <span class='icon'>
                <img src='{$ThemeDir}/images/apostrophe.png'>
            </span>
            <% if $TestimonyContent %>
            <p class='text'>
                {$TestimonyContent}
            </p>
            <% end_if %>
            <% if $Testimony %>
            <p class='testimony'>
                {$Testimony}
            </p>
            <% end_if %>
        </article>
    </section>

</div>