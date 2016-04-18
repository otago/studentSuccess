if(typeof app === 'undefined') { var app = {}; }

(function($){
	"use strict";

	app.accordion = (function(){
		
		var items = $('.accordion-c');
		
		var initItem = function(container) {
			var holder = container;

			holder.find('.title-c a').click(function() {
				var title = $(this).parent();
				
				if(!title.hasClass('active')) { 
					var nextItem = title.next('.accordion-item');

					holder.find('.accordion-item').hide().each(function(i, elem) {
						$(elem).prev('.title-c').removeClass('active');
					});

					title.addClass('active');
					nextItem.addClass('active').show();

					app.carousel.init();
                                        $(".flex-nav-next, .slide-letters li").click(function(){
                                          dataLayer.push({
                                                'event':'ForceClick',
                                                'eventCategory': "carousals", //create a datalayer variable macro called eventCategory
                                                'eventAction': $("h2.active a").html(), //create a datalayer variable macro called eventAction
                                                'eventLabel': window.location.href //create a datalayer variable macro called eventLabel
                                            });
                                            

                                          });

                                          
					if(title.offset().top < $(window).scrollTop()) {
						$('html, body').animate({
							'scrollTop': title.offset().top
						}, 0, function() {
							$(window).trigger('resize');
						});
					} else {
						$(window).trigger('resize');
					}
				}
				else {
					title.removeClass('active').next('.accordion-item').hide();
				}
				
				return false;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			$(".accordion-c .accordion-item:not(.active)").hide();

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