/*!
 * OTP Website - SilverStripers PVT LTD. - Build 1.0.0 
 */
if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.accordion = (function(){
		
		var items = $('.accordion-c');
		
		var initItem = function(container){
			var holder = container;
			holder.find('.title-c a').click(function(){
				var title = $(this).parent();

                // if there is a checkable then check it
                $(this).closest('.checkable').addClass('checked');

				
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
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			
			items.each(function(){
				initItem($(this));
			});
			
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }
if(typeof imagesLoaded === 'undefined') { var imagesLoaded = function(){}; }

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
				var bgCSS = {left: 0, top: 0};
				
				if(!ratio){
					ratio = img.width() / img.height();
					img.data('ratio', ratio);
				} 
				
				var imgWidth = rootWidth;
				var imgHeight = rootWidth / ratio;
				
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
				
			
		};
		
		var setSizeAll = function(){
			items.each(function(){
				setSize($(this));
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			
			items.each(function(){
				var item = this;
				imagesLoaded(item, function(){
					setSize($(item));
				});
			});
			
			$(window).resize(setSizeAll);
		};
		
		return {
			'init'			: init,
			'can'			: can,
			'setSize'		: setSize
		};
		
	})();
	
	
})(jQuery);;
if(typeof app === 'undefined') { var app = {}; }
if(typeof imagesLoaded === 'undefined') { var imagesLoaded = function(){}; }

(function($){
	
	app.carousel = (function(){
		
		var items = $('.carousel-items');
		
		
		var smartItems = $('.smart-slider');
		
		
		var  initSmartSlider = function(holder){
            var holderRef = holder;
            var top = holder.closest('.smart-slide');
            var letters = top.find('.slide-letters li');
            top.find('.slide-letters li:first-child').addClass('active');
			
			var slider = holder.flexslider({
				animation 	    : 'slide',
				smoothHeight	: false,
				prevText		: "",
			    nextText		: "",
				after: function(slider){

                    var current = slider.currentSlide + 1;
                    letters.removeClass('active');
                    top.find('li.letter-' + current).addClass('active');
				}
			});

            letters.click(function(){
                var index = $(this).data('count');
                index -= 1;
                if(index < 0){
                    index = 0;
                }
                holder.flexslider(index);
                return false;
            });
			
			
		};
		
		var initSlider = function(holder){
			
			holder.flexslider({
				'animation' 	: 'slide',
				'smoothHeight'	: false,
				prevText		: "",
			    nextText		: ""
			});
			
		};
		
		var can = function(){
			return items.length > 0 || smartItems.length > 0;
		};
		
		var init = function (){
			items.each(function(){
				initSlider($(this));
			});
			
			smartItems.each(function(){
				initSmartSlider($(this));
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.chosen = (function(){
		
		var items = $('select');
		
		var openDropdown = function(){
			items.chosen();
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			openDropdown();
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.dropdownmenu = (function(){
		
		var items = $('.drop-down-span');
		
		var openDropdown = function(){
			items.click(function(){
				var span = $(this);
				var target = $(span.data('target'));
				
				
				if(target.length){
					if(span.hasClass('active')){
						$('.drop-menu').slideUp();
						span.removeClass('active');
					}
					else{
						$('.drop-menu').not(target).slideUp();
						target.slideDown();
						span.addClass('active');
					}
				}
				
				return;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			openDropdown();
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){

    app.fancybox = (function(){

        var items = $('a.fancybox-link');

        var initFancyBox = function(){

            items.fancybox({
                openEffect : 'none',
                closeEffect : 'none',
                prevEffect : 'none',
                nextEffect : 'none',
                arrows : false,
                helpers : {
                    media : {},
                    buttons : {}
                }
            });

        };

        var can = function(){
            return items.length > 0;
        };

        var init = function (){
            $(document).ready(function(){
                initFancyBox();
            });
        };

        return {
            'init'			: init,
            'can'			: can
        };

    })();


})(jQuery);

;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.fullheight = (function(){
		
		var items = $('.full-height');
		
		var fixHeights = function(){
			var windowWidth = $(window).width();
			
			items.each(function(){
				$(this).attr('style', '');
				if(windowWidth <= 980){
					return;
                }
				
				var parent = $(this).parent();
				$(this).css('min-height', parent.height() + 'px');
				
				var bgImages = $(this).find('.bg-image');
				if(bgImages.length){
					bgImages.each(function(){
						app.bgimage.setSize($(this));
					});
				}
				
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			fixHeights();
			
			$(window).load(function(){
				fixHeights();
				window.setTimeout(fixHeights, 600);
			});
			
			$(window).resize(fixHeights);
			
			
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);
// 
;
if(typeof app === 'undefined') { var app = {}; }

(function($){

    app.glossary = (function(){

        var items = $('.glossary-search');
        var letters = $('.glossary-letter');
        var entries = $('.glossary-item');
        var keyword = $('#glossary-keyword');

        var searchGlossary = function(){
			
            var searchTerm = keyword.val();
            searchTerm = searchTerm.toLowerCase();
            letters.show();
            entries.show();
			
            if(searchTerm){


                var words = searchTerm.split(" ");
                letters.each(function(){
                    var letter = $(this);
                    var terms = letter.find('.glossary-item');
                    var bFound = false;

                    terms.each(function(){
                        var title = $(this).find('h4 a');
                        var text = title.text().toLowerCase();
                        var bWordMatched = false;
						
                        for(var i in words){
                            if(words[i] !== '' && text.indexOf(words[i]) >= 0){
                                bWordMatched = true;
                                break;
                            }
                        }

                        if(bWordMatched){
                            bFound = true;
                        }
                        else{
                            $(this).hide();
                        }

                    });

                    if(!bFound){
                        letter.hide();
                    }

                });

            }

        };

        var can = function(){
            return items.length > 0;
        };

        var init = function (){
            items.submit(function(){
                searchGlossary();
                return false;
            });
        };

        return {
            'init'			: init,
            'can'			: can
        };

    })();


})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.hamburger = (function(){
		
		var items = $('.icon-hamburger');
		
		var openOrCloseMenu = function(){
			$('header.main').toggleClass('opened');
			return false;
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			$('.hamburger').click(function(){
				openOrCloseMenu();
				return false;
			});
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){

    app.helpful = (function(){

        var items = $('.was-this-helpful');

        var can = function(){
            return items.length > 0;
        };

        var SetCookieVal = function(id, type ){
            var strCookie = GetCookieVal();
            var pageID = id;
            var strKey = "_" + pageID + type + "_";
            if(strCookie.indexOf(strKey) == -1){
                strCookie.replace("_" + pageID + "yes_", "");
                strCookie.replace("_" + pageID + "no_", "");
                strCookie += strKey;
            }
            $.cookie('helpful', strCookie, { expires: 7, path: '/' });
        };

        var GetCookieVal = function(){
            var strCookie = $.cookie('helpful');
            if(!strCookie){
                strCookie = "";
                $.cookie('helpful', strCookie, { expires: 7, path: '/' });
            }
            return strCookie;
        };



        var init = function (){

            $(document).ready(function(){
                items.find('a').click(function(){
                    var button = $(this);
                    $('.was-this-helpful a').removeClass('active');
                    SetCookieVal(button.data('id'), button.attr('class'));
                    $.ajax({
                        url: button.attr('href')
                    });

                    button.addClass('active');

                    return false;
                });
            });

            var cookie = GetCookieVal();
            items.each(function(){
                var id = $(this).data('id');
                if(cookie.indexOf("_" + id + "yes_", "") >= 0){
                    $(this).find('a.yes').addClass('active');
                }
                if(cookie.indexOf("_" + id + "no_", "") >= 0){
                    $(this).find('a.no').addClass('active');
                }

            });

        };

        return {
            'init'			: init,
            'can'			: can
        };

    })();


})(jQuery);
// 
;if(typeof app === 'undefined') { var app = {}; }

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
;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.leftrightcont = (function(){
		
		var leftBlock = $('.left-content');
		var rightBlock = $('.right-content');
		
		var sideGaps = function(){
			
			var sideGap = $(window).width();
			
			if( sideGap >= 1200) {
				var leftMargin = (sideGap - 1200) / 2;
				$(leftBlock).css('margin-left',leftMargin);
				$(rightBlock).css('margin-right',(leftMargin + 28));
			}else{
				$(leftBlock).css('margin-left', 0);
				$(rightBlock).css('margin-right', 0);
			}

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
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }
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
            if(sort == 'views'){
                sortAscending = false;
            }

            configs.filter = function(){
                if(subject === '' && keyword === ''){
                    return true;
                }

                var bSubject = false;
                var bKeyword = false;
                var tile = $(this);

                if(subject && subject === tile.data('subject')){
                    bSubject = true;
                }

                if(keyword){
                    var html = tile.text().toLowerCase();
                    if(html.indexOf(keyword) >= 0){
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

		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }
if(typeof FB === 'undefined') { var FB = 'NULL'; }

(function($){

    app.social = (function(){

        var items = $('a.social');


        var initButtons = function(){

            $('a.social.facebook').click(function(){
                var obj = {
                    method: 'share',
                    link: window.location,
                    href: window.location
                };
                if(FB !== 'NULL'){
                    FB.ui(obj, function(response){

                    });
                }
                return false;
            });


            $('a.social.twitter').click(function(){
                $(this).attr('href', 'https://twitter.com/intent/tweet');
                window.open('https://twitter.com/home?status=' + window.location, "Share",
                    "width=640,height=500,resizable=0,fullscreen=0,location=0,toolbar=0"
                );
                return false;
            });

        };

        var can = function(){
            return items.length > 0;
        };

        var init = function (){
            initButtons();
        };

        return {
            'init'			: init,
            'can'			: can
        };

    })();


})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){
	
	app.squareblocks = (function(){
		
		var items = $('.priority-tasks .block-row');
		
		var setBlockHeight = function(){
			
			var rowWidth = $('.block-row ').width();
			
			items.each(function(){
				$('.block').height(rowWidth/2);
			});
			
			$('.titles.left-titles').width(rowWidth - 62);
			return false;
		};
		
		var showHideOverlay = function(){
			
			$('.botLine').click(function(){
				$(this).siblings('.overlay').css("display", "table").fadeIn('slow');
				return false;
			});
			
			$('.overlay .close').click(function(){
				$(this).parent().fadeOut('slow');
				return false;
			});
		};
		
		var can = function(){
			return items.length > 0;
		};
		
		var init = function (){
			setBlockHeight();
			showHideOverlay();
			
			$(window).load(function(){
				setBlockHeight();
				window.setTimeout(setBlockHeight, 600);
			});
			
			$(window).resize(setBlockHeight);

            $('.priority-tasks').addClass('init');

		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

(function($){

    app.svgpng = (function(){

        var can = function(){
            return !Modernizr.svg;
        };

        var init = function (){
            $('img').each(function(){
                var img = $(this);
                var src = img.attr('src');
                if(src){
                    if(src.indexOf('.svg', src.length - 4) !== -1){
                        src = src.replace('.svg', '.png');
                        img.attr('src', src);
                    }
                }

            });
        };

        return {
            'init'			: init,
            'can'			: can
        };

    })();


})(jQuery);;if(typeof app === 'undefined') { var app = {}; }

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
			return items.length > 0;
		};
		
		var init = function (){
			tabbedContent();
		};
		
		return {
			'init'			: init,
			'can'			: can
		};
		
	})();
	
	
})(jQuery);
// 
;if(typeof app === 'undefined') var app = {};

app.MobileSize = 640;

app.Modules = [
    'svgpng',
	'hamburger',
	'bgimage',
	'packery',
	'dropdownmenu',
	'chosen',
	'accordion',
	'carousel',
	'fullheight',
	'itemlist',
	'squareblocks',
	'tabbedcontent',
    'social',
    'fancybox',
    'helpful',
    'glossary',
	'leftrightcont'
];




(function($){
	
	for(key in app.Modules){
		
		var moduleKey = app.Modules[key];
		var module = app[moduleKey]

		if(typeof module.init !== 'undefined' && typeof module.can !== 'undefined'){			
			if(module.can()){
				module.init();
			}
		}
		
	}
	
})(jQuery);