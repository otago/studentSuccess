if(typeof app === 'undefined') { var app = {}; }
if(typeof imagesLoaded === 'undefined') { var imagesLoaded = function(){}; }

(function($){
	
	app.packery = (function(){

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


        var packIt = function(){
			
			items.each(function(){
				var item = $(this);

                if(item.hasClass('filters')){
                    doIsotope(item);
                }
                else{
                    doMasonry(item);
                }
			});

		};


        var doIsotopeFilters = function(item, form){
            var configs = isotopeconfigs;

            var subject = form.find('select.subject-filter').val();
            var keyword = form.find('.keywords').val().toLowerCase();
            var sort = form.find('select.sort-filter').val();
            var sortAscending = true;

            if(sort == 'views') {
                sortAscending = false;
            }

            configs.filter = function(){
                if(subject === '' && keyword === '') {
                    return true;
                }

                var bSubject = false;
                var bKeyword = false;
                var tile = $(this);

                if(subject && subject === tile.data('subject')) {
                    bSubject = true;
                }

                if(keyword) {
                    var html = tile.text().toLowerCase();
                    
                    if(html.indexOf(keyword) >= 0) {
                        bKeyword = true;
                    }
                }

                return bSubject || bKeyword;
            };

            configs.sortBy = sort;
            configs.sortAscending = sortAscending;
            item.isotope(configs);
        };

        /**
         *
         * @param item
         */
        var doIsotope = function(item){
            var form = $('.' + item.data('filterform'));

            form.submit(function(){
                doIsotopeFilters(item, form);
                return false;
            });

            form.find('select.subject-filter').change(function(){
                doIsotopeFilters(item, form);
            });

            form.find('select.sort-filter').change(function(){
                doIsotopeFilters(item, form);
            });
			
			form.find('input.keywords').keyup(function(){
				if(!$(this).val()){
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
                if($(this).hasClass('has-link')) {
                    window.location.href = $(this).find('a').attr('href');
                }
            });
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);