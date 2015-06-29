
if(typeof app === 'undefined') { var app = {}; }
if(typeof imagesLoaded === 'undefined') { var imagesLoaded = function(){}; }

(function($) {
	app.carousel = (function() {
		var items = $('.carousel-items');
		var smartItems = $('.smart-slider');
		
		var  initSmartSlider = function(holder){
            var holderRef = holder;
            var top = holder.closest('.smart-slide');
            var letters = top.find('.slide-letters li');
            top.find('.slide-letters li:first-child').addClass('active');
			
			var slider = holder.flexslider({
				animation 	    : 'slide',
				smoothHeight	: false,
				prevText		: "",
				slideshow		: false,
				animationSpeed  : 200,
			    nextText		: "",
				after: function(slider) {
                    var current = slider.currentSlide + 1;
                    letters.removeClass('active');
                    top.find('li.letter-' + current).addClass('active');
				},
				start: function() {
					$(window).trigger('resize');
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
		
		var initSlider = function(holder) {
			
			holder.flexslider({
				'animation' 	: 'slide',
				'smoothHeight'	: false,
				slideshow		: false,
				animationSpeed  : 200,
				prevText		: "",
			    nextText		: "",
			    start: function(slider) {
			    	$(window).trigger('resize');
			    }
			});
			
		};

		
		var can = function(){
			return items.length > 0 || smartItems.length > 0;
		};
		
		var init = function () {
			function setEqualHeight(selector) {
	      		var heights = new Array();

	       		 $(selector).each(function() {
					$(this).css('min-height', '0');
					$(this).css('max-height', 'none');
					$(this).css('height', 'auto');
					heights.push($(this).height());
				});

				var max = Math.max.apply( Math, heights );
				
				$(selector).each(function() {
					$(this).css('height', max + 'px');
				}); 
			}


	        $(window).resize(function() {
	            setTimeout(function() {
	                setEqualHeight('.slides li');
	            }, 120);
	        });

			items.filter(":visible").each(function() {
				if(!$(this).data('inited')) {
					$(this).data('inited', true);

					initSlider($(this));

	        		setEqualHeight('.slides li');
				}
			});
			
			smartItems.filter(":visible").each(function() {
				if(!$(this).data('inited')) {
					$(this).data('inited', true);

					initSmartSlider($(this));

	       			setEqualHeight('.slides li');
				}
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);