if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.dropdownmenu = (function(){
		
		var items = $('.has_dropdown a');
		
		var openDropdown = function() {
			items.click(function(e) {
				var span = $(this).siblings('.drop-down-span');
				var target = $(span.data('target'));
				
				if(target.length) {
					if(span.hasClass('active')){
						$('.drop-menu').slideUp();
						span.removeClass('active');
					}
					else{
						$('.drop-menu').not(target).slideUp();
						target.slideDown();
						span.addClass('active');
					}
				}
				
				return false;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			openDropdown();
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);