if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.squareblocks = (function(){
		
		var items = $('.priority-tasks .block-row');
		
		var setBlockHeight = function(){
			
			var rowWidth = $('.block-row ').width();
			
			items.each(function(){
				$('.block').height(rowWidth/2);
			});
			
			$('.titles.left-titles').width(rowWidth - 62);
			return false;
		};
		
		var showHideOverlay = function(){
			
			$('.botLine').click(function(){
				$(this).siblings('.overlay').css("display", "table").fadeIn('slow');
				return false;
			});
			
			$('.overlay .close').click(function(){
				$(this).parent().fadeOut('slow');
				return false;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			setBlockHeight();
			showHideOverlay();
			
			$(window).load(function(){
				setBlockHeight();
				window.setTimeout(setBlockHeight, 600);
			});
			
			$(window).resize(setBlockHeight);

            $('.priority-tasks').addClass('init');

		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);