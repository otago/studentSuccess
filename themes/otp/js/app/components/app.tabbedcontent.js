if(typeof app === 'undefined') { var app = {}; }

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
            });

		};
		
		var can = function(){
			return items.length > 0 || $('.template_FilterableCheckList').length > 0;
		};
		
		var init = function () {
			tabbedContent();

			$('.checkform').each(function(i, elem) {
				$(elem).find('#moving').hide();
				$(elem).find('#location').hide();
				$(elem).find('#starting').hide();
				$(elem).find('.action').attr('disabled', 'disabled');

				$("#iam select").change(function(e) {
					$("#moving").show();
				});

				$('#moving select').change(function(e) {
					$("#location").show();
				});

				$("#location select").change(function(e) {
					$(elem).find('.action').removeAttr('disabled');

					$("#starting").show();
				});
			});

			$(".checkable .icon-tick").each(function(i, elem) {
				if(window.localStorage !== "undefined") {
					if(localStorage.getItem($(elem).data('item'))) {
						$(elem).parents('.checkable').addClass('checked');
					}
				}

				$(elem).click(function(e) {
					var checkable = $(this).parents('.checkable');

					if(checkable.hasClass('checked')) {
						checkable.removeClass('checked');

						if(window.localStorage !== "undefined") {
							localStorage.setItem($(this).data('item'), false);
						}
					} else {
						checkable.addClass('checked');

						if(window.localStorage !== "undefined") {
							localStorage.setItem($(this).data('item'), true);
						}
					}
					
					return false;
				});
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);
// 
