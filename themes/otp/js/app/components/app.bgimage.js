if(typeof app === 'undefined') var app = {};

(function($){
	
	app.bgimage = (function(){
		
		var items = $('.bg-image');
		
		var setSize = function(holder){
			
			var images = holder.find('img');
			var topMargin = 0;
			
			if(holder.hasClass('fixed') && holder.data('top') && $(holder.data('top')).length){
				topMargin = $(holder.data('top')).height();
			}
			
			var rootWidth = holder.width();
			var rootHeight = holder.height();
			
			images.each(function(){
				var img = $(this);
				var ratio = img.data('ratio');
				var bgCSS = {left: 0, top: 0}
				
				if(!ratio){
					ratio = img.width() / img.height();
					img.data('ratio', ratio);
				} 
				
				imgWidth = rootWidth;
				imgHeight = rootWidth / ratio;
				
				if(imgHeight > rootHeight){
					var topPos = (-1 * ((imgHeight - rootHeight) / 2)) + topMargin;
					
	            	bgCSS.top = topPos + 'px';
				}
				else{
					imgHeight = rootHeight;
	                imgWidth = imgHeight * ratio;
                  	bgCSS.left = '-' + ((imgWidth - rootWidth) / 2) + 'px';
				}
				
				
				img.css({width: imgWidth, height: imgHeight}).css(bgCSS);
				
				
			});
			
			holder.addClass('loaded');
				
			
		}
		
		var setSizeAll = function(){
			items.each(function(){
				setSize($(this))
			});
		}
		
		var can = function(){
			return items.length > 0;
		}
		
		var init = function (){
			
			items.each(function(){
				var item = this;
				imagesLoaded(item, function(){
					setSize($(item))
				})
			});
			
			$(window).resize(setSizeAll);
		}
		
		return {
			'init'			: init,
			'can'			: can,
			'setSize'		: setSize
		}
		
	})();
	
	
})(jQuery);