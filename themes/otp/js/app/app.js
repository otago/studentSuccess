if(typeof app === 'undefined') var app = {};

app.MobileSize = 640;

app.Modules = [
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
    'fancybox'
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