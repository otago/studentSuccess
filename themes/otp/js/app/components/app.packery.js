if(typeof app === 'undefined') { var app = {}; }
if(typeof imagesLoaded === 'undefined') { var imagesLoaded = function(){}; }

(function($){
	
	app.packery = (function() {

        $(".separator-link").click(function(e) {
            e.preventDefault();
            e.stopPropagation();

            if($(this).hasClass('fancybox-link')) {
                 $(this).fancybox({
                    openEffect : 'none',
                    closeEffect : 'none',
                    prevEffect : 'none',
                    padding: 0,
                    nextEffect : 'none',
                    minWidth: 320,
                    minHeight: 320,
                    arrows : false,
                    helpers : {
                        media : {},
                        buttons : {}
                    },
                    afterShow: function() {
                        app.activities.init();
                    },
                    ajax: {
                        dataFilter: function(data) {
                            if($(data).find('.modal-content').length > 0) {
                                return $(data).find('.modal-content').first();
                            }

                            return data;
                        }
                    }
                });
            } else {
                window.location.href = $(this).attr('href');
            }
        });

		var items = $('.packery');
		
		var configs = {
            'itemSelector'      : '.tile',
			'stamp'				: '.fixed',
		};

        var isotopeconfigs = {
            'itemSelector'      : '.tile',
            'stamp'				: '.fixed',
            'layout'			: 'packery',
            'getSortData'       : {
                title: '[data-title]',
                views: '[data-views]',
                order: '[data-sort]'
            }
        };


        var packIt = function() {
			items.each(function() {
				var item = $(this);

                if(item.hasClass('filters')){
                    doIsotope(item);
                }
                else{
                    doMasonry(item);
                }
			});
		};


        var doIsotopeFilters = function(item, form) {
            var configs = isotopeconfigs;

            var keyword = form.find('.keywords').val().toLowerCase();
            var sort = form.find('select.sort-filter').val();
            var sortAscending = true;

            if($(".token-input-input-token-mac input").length > 0) {
                keyword = $.trim($(".token-input-input-token-mac input").val() + ' '+ $(".token-input-token-mac p").map(function() {
                    return $(this).text();
                }).get().join());
            }

            if(sort == 'views') {
                sortAscending = false;
            }

            configs.filter = function() {
                if(keyword === '') {
                    return true;
                }

                var bKeyword = false;
                var tile = $(this);

                if(keyword) {
                    var title = tile.data('title');

                    if(title && title.toLowerCase().indexOf(keyword.toLowerCase()) >= 0) {
                        return true;
                    }
                    
                    var html = tile.text();

                    if(html && html.indexOf(keyword.toLowerCase()) >= 0) {
                        bKeyword = true;
                    }
                }

                return bKeyword;
            };

            configs.sortBy = sort;
            configs.sortAscending = sortAscending;
            item.isotope(configs);
        };

        /**
         *
         * @param item
         */
        var doIsotope = function(item) {
            var form = $('.' + item.data('filterform'));

            form.submit(function() {
                doIsotopeFilters(item, form);

                return false;
            });

            form.find('select.sort-filter').change(function(){
                doIsotopeFilters(item, form);
            });
			
			form.find('input.keywords').keyup(function(){
				if(!$(this).val()) {
					doIsotopeFilters(item, form);
				}
			});


            var images = item.find('img');

            if(images.length){
                imagesLoaded(this, function(){
                    item.isotope(isotopeconfigs);
                    item.addClass('loaded');
                });
            }
            else{
                item.addClass('loaded');
            }

            if(!item.hasClass('init')){
                item.isotope(isotopeconfigs);
                item.addClass('init');
            }
            else{
                item.isotope(isotopeconfigs);
            }


        };

        /**
         *
         * @param item
         */
        var doMasonry = function(item){
            var images = item.find('img');
            var itemConfigs = configs;

            if(images.length){
                imagesLoaded(this, function(){
                    item.packery(itemConfigs);
                    item.addClass('loaded');
                });
            }
            else{
                item.addClass('loaded');
            }

            if(!item.hasClass('init')){
                item.packery(itemConfigs);
                item.addClass('init');
            }
            else{
                item.packery(itemConfigs);
            }
        };
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			packIt();
			$(window).load(packIt);

            $(".image-tile").click(function(e) {
                e.preventDefault();
                e.stopPropagation();

                if($(this).hasClass('has-link')) {
                    var link = $(this).find('a').first().clone();
                    link.css({
                        'opacity': 0,
                        'height': 0
                    });

                    link.first().trigger('click');
                    link.get(0).click();
                }
            });

            var list = [];
            
            $(".tile").each(function(i, elem) {
                if($(elem).data('title')) {
                    list.push({
                        "id": i,
                        "name": $(elem).data('title')
                    });
                }
            });

            $(".keywords").tokenInput(list, {
                hintText: 'Search by keyword',
                theme: 'mac',
                onAdd: function (item) {
                    $(".filter-form").trigger('submit');
                },
                onDelete: function (item) {
                    $(".filter-form").trigger('submit');
                }
            });

            $('.searchf').click(function(e) {
                e.preventDefault();

                $(".token-input-input-token-mac input").val($(this).text());
                $(".filter-form").submit();
            });

		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);