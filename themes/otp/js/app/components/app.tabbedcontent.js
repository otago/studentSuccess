if(typeof app === 'undefined') var app = {};

(function($){
	
	app.tabbedcontent = (function(){
		
		var items = $('.tabbed-content');
		
		var tabbedContent = function(){
						
			$('.tab-index ul li').click(function(){
                var tab_id = $(this).attr('data-for');

                $('.tab-index ul li').removeClass('active');
                $('.tab-section').removeClass('active');

                $(this).addClass('active');
                $('section'+"."+tab_id).addClass('active');

                vivid.utils.StopAllVideos();
            })

		}
		
		var can = function(){
			return items.length > 0;
		}
		
		var init = function (){
			tabbedContent();
		}
		
		return {
			'init'			: init,
			'can'			: can
		}
		
	})();
	
	
})(jQuery);
// 
