if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.accordion = (function(){
		
		var items = $('.accordion-c');
		
		var initItem = function(container) {
			var holder = container;
			holder.find('.title-c a').click(function() {
				var title = $(this).parent();
				
				if(!title.hasClass('active')) { 
					title.addClass('active');
					
					var nextItem = title.next('.accordion-item');
					
					nextItem.addClass('active').slideDown(function() {
						// may contains carousels.
						app.carousel.init();

						if(title.offset().top < $(window).scrollTop()) {
							$('html, body').animate({
								'scrollTop': title.offset().top
							}, function() {
								$(window).trigger('resize');
							});
						} else {
							$(window).trigger('resize');
						}
					});
				}
				else {
					title.removeClass('active').next('.accordion-item').slideUp();
				}
				
				return false;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			
			items.each(function(){
				initItem($(this));
			});
			
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);