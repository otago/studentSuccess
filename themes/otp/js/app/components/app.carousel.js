
if(typeof app === 'undefined') { var app = {}; }
if(typeof imagesLoaded === 'undefined') { var imagesLoaded = function(){}; }

(function($){
	
	app.carousel = (function(){
		
		var items = $('.carousel-items');
		
		
		var smartItems = $('.smart-slider');
		
		
		var  initSmartSlider = function(holder){
            var holderRef = holder;
            var top = holder.closest('.smart-slide');
            var letters = top.find('.slide-letters li');
            top.find('.slide-letters li:first-child').addClass('active');
			
			var slider = holder.flexslider({
				animation 	    : 'fade',
				smoothHeight	: true,
				prevText		: "",
				slideshow		: false,
				animationSpeed  : 200,
			    nextText		: "",
				after: function(slider) {
                    var current = slider.currentSlide + 1;
                    letters.removeClass('active');
                    top.find('li.letter-' + current).addClass('active');
				}
			});

            letters.click(function(){
                var index = $(this).data('count');
                index -= 1;
                if(index < 0){
                    index = 0;
                }
                holder.flexslider(index);
                return false;
            });
			
			
		};
		
		var initSlider = function(holder){
			
			holder.flexslider({
				'animation' 	: 'slide',
				'smoothHeight'	: true,
				slideshow		: false,
				animationSpeed  : 200,
				prevText		: "",
			    nextText		: ""
			});
			
		};
		
		var can = function(){
			return items.length > 0 || smartItems.length > 0;
		};
		
		var init = function (){
			items.each(function(){
				initSlider($(this));
			});
			
			smartItems.each(function(){
				initSmartSlider($(this));
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);