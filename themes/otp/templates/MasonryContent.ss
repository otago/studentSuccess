<section class='page-intro clear-this'>
    <article>
        <h1 class='title'>{$DisplayTitle}</h1>
        <% if $Intro %>
            <p>{$Intro}</p>
        <% end_if %>
    </article>
</section>


<div class='masonry-content'>
    <div class='packery'>
        <div class='tile tile-c half width-c'></div>
        <% loop $Tiles %>
            $Render
        <% end_loop %>
        <% if $ShowContacts %>
            <% include ContactTile %>
        <% end_if %>
    </div>
</div>