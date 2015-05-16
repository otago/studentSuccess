<section class='page-intro'>
    <article>
        <h1 class='title'>{$DisplayTitle}</h1>
        <% if $Intro %>
            <p>{$Intro}</p>
        <% end_if %>
    </article>
</section>


<div class='masonry-content'>
    <div class='packery'>
        <% if $ShowContacts %>
            <% include ContactTile %>
        <% end_if %>
        <% loop $Tiles %>
            $Render
        <% end_loop %>
    </div>
</div>