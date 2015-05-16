if(typeof app === 'undefined') var app = {};

(function($){
	
	app.packery = (function(){
		
		var items = $('.packery');
		
		var configs = {
			'.itemSelector'		: '.tile',
			'stamp'				: '.fixed'
		};
		
		var packIt = function(){
			
			items.each(function(){
				var item = $(this);
				var images = $(this).find('img');
				
				if(images.length){
					imagesLoaded(this, function(){
						item.packery(configs);
						item.addClass('loaded');
					});
				}
				else{
					item.addClass('loaded');
				}   
				
				if(!item.hasClass('init')){
					item.packery(configs);
					item.addClass('init');
				}
				else{
					item.packery(configs);
				}
				
			});
			
			
		}
		
		var can = function(){
			return items.length > 0;
		}
		
		var init = function (){
			packIt();
			
			$(window).load(packIt);
			
			//$(window).resize(setSize);
		}
		
		return {
			'init'			: init,
			'can'			: can
		}
		
	})();
	
	
})(jQuery);