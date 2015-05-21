if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.itemlist = (function(){
		
		var items = $('.checklist');
		
		var toggleItems = function(item){
			item.find('.icon').removeClass('icon-tick');
			var holder = item.closest('.checklist');
			var desc = holder.find('.' + item.data('for'));
			item.parent().find('input').prop('checked', false);
			
			holder.find('.desc').not(desc).removeClass('active');
			holder.find('.desc').find('input').prop('checked', false);
			holder.find('.index li').not(item).removeClass('active');
			
			holder.find('.desc').find('.icon').removeClass('icon-tick');
			holder.find('.desc').find('.icon').addClass('icon-dot');
			
			if(item.hasClass('active')){
				desc.removeClass('active');
				item.removeClass('active');
				item.find('.icon').removeClass('icon-select');
				
			}
			else{
				desc.addClass('active');
				item.addClass('active');
				item.find('.icon').removeClass('icon-dot');
				item.find('.icon').addClass('icon-select');
				
				
			}
			
		};
		
		var toggleSecondLevels = function(item){
			if(item.hasClass('active')){
				item.removeClass('active');
				item.parent().find('input.'+item.data('input')).prop('checked', false);
			}else{
				item.addClass('active');
				item.parent().find('input.'+item.data('input')).prop('checked', true);
			}
			
			
			var icon =item.find('.icon');
			if(icon.hasClass('icon-tick')){
				icon.removeClass('icon-tick');
				icon.addClass('icon-dot');
			}else{
				icon.addClass('icon-tick');
				icon.removeClass('icon-dot');
			}
			
			CheckALLSelected(item.parents('.desc'),item.parents('.desc'));
		};
		
		var CheckALLSelected = function(item,parent){
			var allselected = true;
			var selector = item.data('parent');
			$('.'+selector+' ul li').each(function( index ){
				
				if(!$(this).hasClass('active')){
					
					allselected = false;
					return false;
				}
			});
			
			var parentSelector= parent.data('parent');

            var holder = parent.closest('.checklist');
            var indexli = holder.find(".index li[data-for ='"+parentSelector+"']");
			if(allselected){
				indexli.find('.icon').addClass('icon-tick');
				indexli.parent().find('input.'+indexli.data('for')).prop('checked', true);
			}else{
				indexli.find('.icon').removeClass('icon-tick');
				indexli.find('.icon').addClass('icon-select');
				indexli.parent().find('input.'+indexli.data('for')).prop('checked', false);
			}
			
			
		};
		
		var initFirst = function(){
			items.each(function(){
				toggleItems($(this).find('.index li:first-child'));
			});
		};
		
		var initEvents = function(){
			items.find('.index li').click(function(){
				toggleItems($(this));
				return false;
			});
			
			items.find('.desc li').click(function(){
				toggleSecondLevels($(this));
				return false;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			initEvents();
			initFirst();
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);
// 
