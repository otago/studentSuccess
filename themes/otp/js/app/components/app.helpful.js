if(typeof app === 'undefined') { var app = {}; }

(function($){

	app.helpful = (function(){

		var items = $('.was-this-helpful');

		var can = function(){
			return items.length > 0;
		};

		var SetCookieVal = function(id, type ) {
			$.cookie('helpful'+id, type, { expires: 7, path: '/' });
		};

		var init = function (){

			$(document).ready(function(){
				items.find('a').click(function() {
					var button = $(this);
					
					$('.was-this-helpful a').removeClass('active');
					SetCookieVal(button.data('id'), button.attr('class'));
                                            
					$.ajax({
						url: button.attr('href')
					});
                                        
					button.addClass('active');
					button.siblings('.active').removeClass('active');
                                        dataLayer.push({
                                            'event':'ForceClick',
                                            'eventCategory': 'Helpful', //create a datalayer variable macro called eventCategory
                                            'eventAction': 'Was this Helpful - '+button.text(), //create a datalayer variable macro called eventAction
                                            'eventLabel': window.location.href  //create a datalayer variable macro called eventLabel
                                        });
					return false;
				});
			});

			items.each(function(){
				var id = $(this).data('id');
				var cookieVal  = $.cookie('helpful'+id);

				if(cookieVal === "yes") {
					$(this).find('a.yes').addClass('active');
				}
				else if(cookieVal === "no") {
					$(this).find('a.no').addClass('active');
				}
			});
		};

		return {
			'init'			: init,
			'can'			: can
		};
	})();
})(jQuery);
// 
