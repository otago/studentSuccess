<section class='{$Size} col career-handbook tile'>
    {$Image}
    <% if $Icon %><span class='icon {$Icon}'></span><% end_if %>
    <article>
        <h3>{$Title}</h3>
        <% if $Description %><p>
            {$Description}
        </p><% end_if %>
    </article>
</section>