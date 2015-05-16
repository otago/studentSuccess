if(typeof app === 'undefined') var app = {};

(function($){
	
	app.fullheight = (function(){
		
		var items = $('.full-height');
		
		var fixHeights = function(){
			var windowWidth = $(window).width();
			
			items.each(function(){
				$(this).attr('style', '');
				if(windowWidth <= 980)
					return;
				
				var parent = $(this).parent();
				$(this).css('min-height', parent.height() + 'px');
				
				var bgImages = $(this).find('.bg-image');
				if(bgImages.length){
					bgImages.each(function(){
						app.bgimage.setSize($(this));
					});
				}
				
			});
		}
		
		var can = function(){
			return items.length > 0;
		}
		
		var init = function (){
			fixHeights();
			
			$(window).load(function(){
				fixHeights();
				window.setTimeout(fixHeights, 600);
			});
			
			$(window).resize(fixHeights);
			
			
		}
		
		return {
			'init'			: init,
			'can'			: can
		}
		
	})();
	
	
})(jQuery);
// 
