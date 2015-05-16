if(typeof app === 'undefined') var app = {};

(function($){
	
	app.itemlist = (function(){
		
		var items = $('.checklist');
		
		var toggleItems = function(item){
			var holder = item.closest('.checklist');
			var desc = holder.find('.' + item.data('for'));
			
			holder.find('.desc').not(desc).removeClass('active');
			holder.find('.index li').not(item).removeClass('active');
			
			if(desc.hasClass('active')){
				desc.removeClass('active');
				item.removeClass('active');
			}
			else{
				desc.addClass('active');
				item.addClass('active');
			}
			
		}
		
		var initFirst = function(){
			items.each(function(){
				toggleItems($(this).find('.index li:first-child'));
			});
		}
		
		var initEvents = function(){
			items.find('.index li').click(function(){
				toggleItems($(this))
				return false;
			});
		}
		
		var can = function(){
			return items.length > 0;
		}
		
		var init = function (){
			initEvents();
			initFirst();
		}
		
		return {
			'init'			: init,
			'can'			: can
		}
		
	})();
	
	
})(jQuery);
// 
