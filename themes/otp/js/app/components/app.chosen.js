if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.chosen = (function(){
		
		var items = $('select');
		
		var openDropdown = function() {
			items.chosen({
				disable_search: true
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