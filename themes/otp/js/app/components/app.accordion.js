if(typeof app === 'undefined') var app = {};

(function($){
	
	app.accordion = (function(){
		
		var items = $('.accordion-c');
		
		var initItem = function(container){
			var holder = container;
			holder.find('.title-c a').click(function(){
				var title = $(this).parent();
				
				if(!title.hasClass('active')){
					title.addClass('active');
					var nextItem = title.next('.accordion-item');
					holder.find('.accordion-item').not(nextItem).removeClass('active').slideUp();
					holder.find('.title-c').not(title).removeClass('active');
					
					nextItem.addClass('active').slideDown();
				}
				else{
					title.removeClass('active');
					holder.find('.accordion-item').removeClass('active').slideUp();
				}
				
				return false;
			});
		}
		
		var can = function(){
			return items.length > 0;
		}
		
		var init = function (){
			
			items.each(function(){
				initItem($(this));
			});
			
		}
		
		return {
			'init'			: init,
			'can'			: can
		}
		
	})();
	
	
})(jQuery);