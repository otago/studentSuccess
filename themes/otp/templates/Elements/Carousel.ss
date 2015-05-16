<% if $Slides %>
<div class='carousel content-slide {$Background}'>
    <div class="component-alignment carousel-items">
        <ul class='slides'>
            <% loop $Slides %>
                $Render
            <% end_loop %>
        </ul>
    </div>
</div>
<% end_if %>