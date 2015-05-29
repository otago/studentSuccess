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

			// clicking the arrow should trigger the link
			$(".drop-down-span").click(function() {
				$(this).siblings('a').trigger('click');
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function () {
			openDropdown();

			$(".level-1 input").on('focus', function() {
				$(this).addClass('wide');
			});

			$(".level-1 input").on('blur', function() {
				$(this).removeClass('wide');
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);