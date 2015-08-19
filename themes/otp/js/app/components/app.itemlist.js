if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.itemlist = (function() {
		
		var items = $('.checklist');
		
		var toggleItems = function(item) {
			var holder = item.closest('.checklist');
			var desc = holder.find('.' + item.data('for'));

			holder.find('.desc').not(desc).removeClass('active');
			holder.find('.index li').not(item).removeClass('active');
			
			if(item.hasClass('active')) {
				return;
			}
			else {
				desc.addClass('active');
				item.addClass('active');
			}
		};
		
		var toggleSecondLevels = function(item) {
			if(item.hasClass('active')) {
				item.removeClass('active');

				item.parent().find('input.'+item.data('input')).prop('checked', false);
			} else {
				item.addClass('active');
				item.parent().find('input.'+item.data('input')).prop('checked', true);
			}
			
			
			var icon =item.find('.icon');
			if(icon.hasClass('icon-tick')) {
				icon.removeClass('icon-tick');
				icon.addClass('icon-dot');
			}else{
				icon.addClass('icon-tick');
				icon.removeClass('icon-dot');
			}
			
			CheckALLSelected(item.parents('.desc'),item.parents('.desc'));
		};
		
		var CheckALLSelected = function(item,parent) {
			var allselected = true;
			var selector = item.data('parent');
			$('.'+selector+' ul li').each(function(i){
				
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
		
		var initFirst = function() {
			items.each(function(){
				toggleItems($(this).find('.index li:first-child'));
			});
		};
		
		var initEvents = function() {
			// load from 
			items.find('.index .icon').each(function(i, elem) {
				if($(elem).hasClass('arrow')) {
					return;
				}

				if(window.localStorage !== "undefined") {
					if(localStorage.getItem($(elem).data('for'))) {
						$(this).removeClass('icon-select');
						$(this).addClass('icon-tick');
						$(this).parents('li').first().addClass('ticked');
					} else {
						$(this).addClass('icon-select');
					}
				}
			});

			items.find('.index li .icon').click(function(e) {
				if($(this).hasClass('arrow')) {
					return;
				}

				if($(this).hasClass('icon-select')) {
					$(this).removeClass('icon-select');
					$(this).addClass('icon-tick');
					$(this).parents('li').first().addClass('ticked');

					if(window.localStorage !== "undefined") {
						localStorage.setItem($(this).data('for'), true);
					}
				} else {
					$(this).removeClass('icon-tick');
					$(this).addClass('icon-select');
					$(this).parents('li').first().removeClass('ticked');

					if(window.localStorage !== "undefined") {
						localStorage.setItem($(this).data('for'), false);
					}
				}

				return false;
			});

			var resizePaddingTop = function(self) {
				// set the padding for the element
				var $pt = $(self).offset().top - $(self).parents('.index').offset().top;
		
				$('.mainlist.'+ $(self).data('for')).css('padding-top', $pt);
			};

			items.find('.index li.main').click(function() {
				resizePaddingTop($(this));
				
				$(this).addClass('changed');

				toggleItems($(this));

				// scroll the user 
				if($(window).scrollTop() > $(this).offset().top) {
					$("html, body").animate({
						'scrollTop': $(this).offset().top
					});
				}

				return false;
			});

			$(window).resize(function() {
				$(".index li.main.changed").each(function() {
					resizePaddingTop($(this));
				});
			});
			
			items.find('.desc li').each(function(i, elem) {
				if(window.localStorage !== "undefined") {
					if(localStorage.getItem($(elem).data('input')) === "true") {
						toggleSecondLevels($(elem));
					}
				}
			}).click(function() {
				if(window.localStorage !== "undefined") {
					if($(this).find('.icon-dot').length > 0) {
						localStorage.setItem($(this).data('input'), "true");
					} else {
						localStorage.setItem($(this).data('input'), "false");
					}
				}

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
