<div class="component-alignment boxed-element">
	<section class="priority-tasks clear-this">
		<div class="titles row">
			<span class="col left">{$LabelTopLeft}</span>
			<span class="col">{$LabelTopRight}</span>
		</div>


		<div class="block-row row top-row">
			<div class="titles labeltopleft">
				<span>$LabelTopLeft</span>
			</div>

			<div class="block col left">
				<div class="topLine">
					<span class="text">{$CellTopLeftTitle.LimitCharacters(80)}</span>
				</div>

				<div class="botLine">
					<span class="icon icon-dark-up-arrow"></span>
					<span class="text">{$CellTopLeftContent.LimitCharacters(100)}</span>
				</div>

				<div class="overlay">
					<span class="icon icon-close close"></span>
					{$OverlayHTML('OverlayTopLeft')}
				</div>
			</div>

			<div class="block col">
				<div class="topLine">
					<span class="text">{$CellTopRightTitle.LimitCharacters(80)}</span>
				</div>

				<div class="botLine">
					<span class="icon icon-dark-up-arrow"></span>
					<span class="text">{$CellTopRightContent.LimitCharacters(60)}</span>
				</div>

				<div class="overlay">
					<span class="icon icon-close close"></span>
					{$OverlayHTML('OverlayTopRight')}
				</div>
			</div>
		</div>

		<div class="block-row row">
			<div class="titles labelbottomleft">
				<span>$LabelLeftBottom</span>
			</div>

			<div class="block col left">
				<div class="topLine">
					<span class="text">{$CellBottomLeftTitle.LimitCharacters(80)}</span>
				</div>
				<div class="botLine">
					<span class="icon icon-dark-up-arrow"></span>
					<span class="text">{$CellBottomLeftContent.LimitCharacters(60)}</span>
				</div>
				<div class="overlay">
					<span class="icon icon-close close"></span>
					{$OverlayHTML('OverlayBottomLeft')}
				</div>
			</div>

			<div class="block col">
				<div class="topLine">
					<span class="text">{$CellBottomRightTitle.LimitCharacters(80)}</span>
				</div>
				<div class="botLine">
					<span class="icon icon-dark-up-arrow"></span>
					<span class="text">{$CellBottomRightContent.LimitCharacters(60)}</span>
				</div>
				<div class="overlay">
					<span class="icon icon-close close"></span>
					{$OverlayHTML('OverlayBottomRight')}
				</div>
			</div>
		</div>
	</section>
</div>
