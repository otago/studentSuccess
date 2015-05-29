<div class='hear-from-others clear-this'>
	<div class="component-alignment boxed-element">
    	<h2>{$DisplayTitle}</h2>
	</div>
	<div class="component-alignment boxed-element">
    	<section>

	        	<div class='image'>
		            <% if $VideoURL %>
		                <a href="{$VideoURL}" class="video-image fancybox-link">{$Image.Pure}</a>
		                <a href='{$VideoURL}' class='icon icon-play fancybox-link'></a>
		            <% else %>
		                {$Image.Pure}
		            <% end_if %>
		        </div>
		        <article>
		        	<span class="quotemark">&quot;</span>
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
		        </article>

	    </section>
	</div>
</div>