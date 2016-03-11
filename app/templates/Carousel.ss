<% with $Widget %> 
<% if $Slides %>
<div class='carousel content-slide {$Background} clear-this'>
    <div class="component-alignment carousel-items boxed-element">
        <ul class='slides'>
            <% loop $Slides %>
                $Render
            <% end_loop %>
        </ul>
    </div>
</div>
<% end_if %>
<% end_with %>