<section class="priority-tasks">
    <div class="titles left-titles row hideInMobile">
        <span class="col left">{$LabelLeftBottom}</span>
        <span class="col">{$LabelLeftTop}</span>
    </div>
    <div class="titles top-titles row hideInMobile">
        <span class="col left">{$LabelTopLeft}</span>
        <span class="col">{$LabelTopRight}</span>
    </div>
    <div class="block-row row top-row">
        <div class="titles row showInMobile">
            <span class="col left">{$LabelTopLeft}</span>
            <span class="col middle">&nbsp;</span>
            <span class="col">{$LabelLeftTop}</span>
        </div>
        <div class="block col left">
            <div class="topLine">
                <span class="text">{$CellTopLeftTitle}</span>
            </div>
            <div class="botLine">
                <span class="icon icon-dark-up-arrow"></span>
                <span class="text">{$CellTopLeftContent}</span>
            </div>
            <div class="overlay">
                <span class="icon icon-close close"></span>
                {$OverlayHTML('OverlayTopLeft')}
            </div>
        </div>
        <div class="titles row showInMobile">
            <span class="col left">{$LabelTopRight}</span>
            <span class="col middle">&nbsp;</span>
            <span class="col">{$LabelLeftTop}</span>
        </div>
        <div class="block col">
            <div class="topLine">
                <span class="text">{$CellTopRightTitle}</span>
            </div>
            <div class="botLine">
                <span class="icon icon-dark-up-arrow"></span>
                <span class="text">{$CellTopRightContent}</span>
            </div>
            <div class="overlay">
                <span class="icon icon-close close"></span>
                {$OverlayHTML('OverlayTopRight')}
            </div>
        </div>
    </div>
    <div class="block-row row">
        <div class="titles row showInMobile">
            <span class="col left">{$LabelTopLeft}</span>
            <span class="col middle">&nbsp;</span>
            <span class="col">{$LabelLeftBottom}</span>
        </div>
        <div class="block col left">
            <div class="topLine">
                <span class="text">{$CellBottomLeftTitle}</span>
            </div>
            <div class="botLine">
                <span class="icon icon-dark-up-arrow"></span>
                <span class="text">{$CellBottomLeftContent}</span>
            </div>
            <div class="overlay">
                <span class="icon icon-close close"></span>
                {$OverlayHTML('OverlayBottomLeft')}
            </div>
        </div>
        <div class="titles row showInMobile">
            <span class="col left">{$LabelTopRight}</span>
            <span class="col middle">&nbsp;</span>
            <span class="col">{$LabelLeftBottom}</span>
        </div>
        <div class="block col">
            <div class="topLine">
                <span class="text">{$CellBottomRightTitle}</span>
            </div>
            <div class="botLine">
                <span class="icon icon-dark-up-arrow"></span>
                <span class="text">{$CellBottomRightContent}</span>
            </div>
            <div class="overlay">
                <span class="icon icon-close close"></span>
                {$OverlayHTML('OverlayBottomRight')}
            </div>
        </div>
    </div>
</section>