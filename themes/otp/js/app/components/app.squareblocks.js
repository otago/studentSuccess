if(typeof app === 'undefined') { var app = {}; }

(function($) {
	app.squareblocks = (function() {
		var items = $('.priority-tasks .block-row');
		
		var showHideOverlay = function() {
			$('.botLine').click(function() {
				$(this).siblings('.overlay').show();

				return false;
			});
			
			$('.overlay .close').click(function() {
				$(this).parent().hide();

				return false;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function () {
			showHideOverlay();
			
            $('.priority-tasks').addClass('init');
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
	})();
})(jQuery);