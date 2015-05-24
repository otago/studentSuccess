if(typeof app === 'undefined') { var app = {}; }

(function($) {
	app.chosen = (function() {
		
		var can = function() {
			return $(".activity_navigation .btn").length < 1;
		};
		
		var init = function () {
			$(".activity_navigation .btn").on('click', function(e) {
				e.preventDefault();

				// validate the current step
				var valid = true;

				//...

				if(valid) {
					// if 
				}
			})
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
	})();
})(jQuery);