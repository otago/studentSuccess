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
                if($(this).data('target') === '_blank') {
                    var win = window.open($(this).attr('href'), '_blank');
                    win.focus();
                } else {
                    window.location.href = $(this).attr('href');
                }
            }
        });

		var items = $('.packery');
		
		var configs = {
            'itemSelector'      : '.tile',
			'stamp'				: '.fixed',
            'transitionDuration': '0.2s'
		};

        var isotopeconfigs = {
            'itemSelector'      : '.tile',
            'stamp'				: '.fixed',
            'layout'			: 'packery',
            'transitionDuration': '0.2s',
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

        var scheme = [
            'red',
            'black',
            'green',
            'yellow',
            'white',
            'blue',
            'mint'
        ];

        var resetColors = function() {
            var v = 0;

            $('.tile-c').each(function(i, elem) {
                if($(elem).hasClass('image-tile') || $(elem).hasClass('list-menu') || $(elem).hasClass('fixed-right') || $(elem).hasClass('contact-tile')) {
                    return;
                }

                $(elem)
                    .removeClass('scheme_red scheme_black scheme_blue scheme_green scheme_yellow scheme_white scheme_mint');
                
                if($(elem).is(":visible")) {
                    $(elem).attr('data-v', v);
                    $(elem).addClass('scheme_'+ scheme[v % 7]);

                    v++;
                }
            });
        };

        function onArrange( event, filteredItems) {
            var v = 0;

            $.each(filteredItems, function(i, elem) {
                var element = $(elem).get(0).element;

                if($(element).hasClass('list-menu') || $(element).hasClass('contact-tile') || $(element).hasClass('image-tile') || $(elem).hasClass('fixed-right')) {
                    return;
                }

                $(element)
                    .removeClass('scheme_red scheme_black scheme_blue scheme_green scheme_yellow scheme_white scheme_mint');

                $(element).addClass('scheme_'+ scheme[v % 7]);

                v++;
            });
        }


        resetColors();

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

            if(sort === 'views') {
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
            var $pack = item.isotope(configs);

            // bind event listener
            $pack.on( 'layoutComplete', onArrange );
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


            item.packery('unbindResize');

            resetColors();

            function debounce(func, wait, immediate) {
                var timeout;
                return function() {
                    var context = this, args = arguments;
                    var later = function() {
                        timeout = null;
                        if (!immediate) {
                            func.apply(context, args);
                        }
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) {
                        func.apply(context, args);
                    }
                };
            }

            var repackIt = debounce(function() {
                item.packery().css('opacity', 1);
            }, 250);

            $(window).on("resize", function () {
                item.css('opacity', 0.1);

                repackIt();
            });
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

            $(".template_LandingSearchPage .keywords").tokenInput(list, {
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

                var ids = $(this).data('show-items');

                var configs = isotopeconfigs;
                var sort = $('body').find('select.sort-filter').val();
                var sortAscending = true;

                if(sort === 'views') {
                    sortAscending = false;
                }

                configs.filter = function() {
                   var tile = $(this);

                    if(ids.indexOf(tile.data('itemid')) > -1) {
                       return true;
                    } else {
                       return false;
                    }
                };

                configs.sortBy = sort;
                configs.sortAscending = sortAscending;

                var $pack = $(this).parents('.packery').isotope(configs);

                // bind event listener
                $pack.on( 'layoutComplete', onArrange );
            });
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery); 