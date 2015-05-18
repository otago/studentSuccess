<% if $Slides %>
<div class='smart-slide {$Background}'>
        <ul class="slide-letters">
            <% loop $Slides %>
                <li class="letter-{$Pos}" data-count="{$Pos}" style="width: {$Width}%;"><h1>$UpperLetter</h1></li>
            <% end_loop %>
        </ul>
        <div class="carousel">
            <div class="component-alignment smart-slider boxed-element">
                <ul class='slides'>
                    <% loop $Slides %>
                        <li id="letter-{$Pos}" class='title-content-compact'>
                            $Render
                        </li>
                    <% end_loop %>
                </ul>
            </div>
        </div>
</div>
<% end_if %>