if(typeof app === 'undefined') var app = {};

(function($){
	
	app.dropdownmenu = (function(){
		
		var items = $('.drop-down-span');
		
		var openDropdown = function(){
			items.click(function(){
				var span = $(this);
				var target = $(span.data('target'));
				
				
				if(target.length){
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
				
				return;
			});
		}
		
		var can = function(){
			return items.length > 0;
		}
		
		var init = function (){
			openDropdown();
		}
		
		return {
			'init'			: init,
			'can'			: can
		}
		
	})();
	
	
})(jQuery);