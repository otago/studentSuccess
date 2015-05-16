
if(typeof app === 'undefined') var app = {};

(function($){
	
	app.carousel = (function(){
		
		var items = $('.carousel-items');
		
		
		var initSlider = function(holder){
			
			holder.flexslider({
				'animation' 	: 'slide',
				'smoothHeight'	: false,
				prevText		: "",
			    nextText		: ""
			
			/*
				before: function(){
					var active_block = $(this).find('.flex-active-slide').attr('id');
					$('body').find('.slide-letters li' + '.' +active_block).addClass('active');
				},*/
			});
			
		}
		
		var can = function(){
			return items.length > 0;
		}
		
		var init = function (){
			items.each(function(){
				initSlider($(this));
			});
		}
		
		return {
			'init'			: init,
			'can'			: can
		}
		
	})();
	
	
})(jQuery);