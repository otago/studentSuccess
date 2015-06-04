<div class="component-alignment">
	<section class='page-intro'>
		<article>
			<h1 class='title'>{$Title}</h1>
			<% if $Intro %>
				<p>{$Intro}</p>
			<% end_if %>
		</article>

		<div class='social-blocks'>
			<ul>
				<li><a href='http://www.facebook.com/sharer.php?src=sp&u={$AbsoluteLink}' class="facebook social"><span class='icon icon-facebook'></span></a></li>
				<li><a href='http://twitter.com/home?status={$Title.URLATT}' class="twitter social"><span class='icon icon-twitter'></span></a></li>
				<li><a href='mailto:?subject={$Title.ATT}&body={$Intro.ATT}' class="email social"><span class='icon icon-mail'></span></a></li>
			</ul>
		</div>
	</section>
</div>