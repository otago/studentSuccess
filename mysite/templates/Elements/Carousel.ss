<% if $Slides %>
<div class='carousel content-slide {$Background} clearThis'>
    <div class="component-alignment carousel-items boxed-element">
        <ul class='slides'>
            <% loop $Slides %>
                $Render
            <% end_loop %>
        </ul>
    </div>
</div>
<% end_if %>