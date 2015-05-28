if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.leftrightcont = (function(){
		
		var leftBlock = $('.left-content');
		var rightBlock = $('.right-content');
		
		var sideGaps = function(){
/*


			var sideGap = $(window).width();
			
			if( sideGap >= 1200) {
				var leftMargin = (sideGap - 1200) / 2;
				$(leftBlock).css('margin-left',leftMargin);
				$(rightBlock).css('margin-right',(leftMargin + 28));
			}else{
				$(leftBlock).css('margin-left', 0);
				$(rightBlock).css('margin-right', 0);
			}*/

            leftBlock.addClass('init');
            rightBlock.addClass('init');
			
			return false;
		};
		
		var can = function(){
			return leftBlock.length > 0 || rightBlock.length > 0;
		};
		
		var init = function (){
			sideGaps();
			
			$(window).load(function(){
				sideGaps();
			});
			
			$(window).resize(sideGaps);
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);