    <% if $Slides %>
    <div class='smart-slide {$Background}'>
        <div class="component-alignment boxed-element">
            <ul class="slide-letters">
                <% loop $Slides %>
                    <li class="letter-{$Pos}" data-count="{$Pos}">$UpperLetter</li>
                <% end_loop %>
            </ul>
        </div>

        <div class="carousel">
            <div class="component-alignment smart-slider boxed-element">
                <ul class='slides'>
                    <% loop $Slides %>
                        <li id="letter-{$Pos}" class='title-content-compact'>
                            <div class='wrapper'>
                                <div class='holder'>
                                    <div class='slide-intro'>
                                        <h3 class='title position-{$Pos}-{$Up.Slides.Count}'>
                                            <span class='icon icon-head-arrow'></span>{$Title}
                                        </h3>

                                        <div class="content">
                                            $Content
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <% end_loop %>
                </ul>
            </div>
        </div>
    </div>
    <% end_if %>
