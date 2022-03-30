<% if $Widget %>
<% with $Widget %> 
<div class='hear-from-others clear-this {$Color}'>
	<div class="component-alignment wide-boxed-element">
		<section>
			<div class='image'>
				<% if $VideoURL %>
					<a href="{$VideoURL}" <% if ExternalURL %>target="_blank"<% end_if %> class="video-image <% if not ExternalURL %>fancybox-link<% end_if %>"><span class="icon icon-play"></span>$Image</a>
				<% else %>
					$Image
				<% end_if %>
			</div>
		
			<article>
				<span class="quotemark">“</span>

				<% if $TestimonyContent %>
					<p class='text'>
						{$TestimonyContent}
					</p>
				<% end_if %>
				
				<% if $Testimony %>
					<p class='testimony'>
						{$Testimony}
					</p>
				<% end_if %>

				<% if VideoTime %>
					<span class="time">$VideoTime</span>
				<% end_if %>
			</article>
	    </section>
	</div>
</div>
<% end_with %>
<% else %>
<div class='hear-from-others clear-this {$Color}'>
	<div class="component-alignment wide-boxed-element">
		<section>
			<div class='image'>
				<% if $VideoURL %>
					<a href="{$VideoURL}" <% if ExternalURL %>target="_blank"<% end_if %> class="video-image <% if not ExternalURL %>fancybox-link<% end_if %>"><span class="icon icon-play"></span>$Image</a>
				<% else %>
					$Image
				<% end_if %>
			</div>
		
			<article>
				<span class="quotemark">“</span>

				<% if $TestimonyContent %>
					<p class='text'>
						{$TestimonyContent}
					</p>
				<% end_if %>
				
				<% if $Testimony %>
					<p class='testimony'>
						{$Testimony}
					</p>
				<% end_if %>

				<% if VideoTime %>
					<span class="time">$VideoTime</span>
				<% end_if %>
			</article>
	    </section>
	</div>
</div>
<% end_if %>