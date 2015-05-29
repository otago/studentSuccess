if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.hamburger = (function(){
		
		var items = $('.icon-hamburger');
		
		var openOrCloseMenu = function(){
			$('header.main').toggleClass('opened');

			if(!$('header.main').hasClass('opened')) {
				$(".drop-menu").hide();
			}
			return false;
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			$('.hamburger').click(function(){
				openOrCloseMenu();
				return false;
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);