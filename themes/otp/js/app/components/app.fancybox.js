if(typeof app === 'undefined') { var app = {}; }

(function($){

    app.fancybox = (function(){

        var items = $('a.fancybox-link');

        var initFancyBox = function() {

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
            $(document).ready(function() {
                initFancyBox();
            });
        };

        return {
            'init'			: init,
            'can'			: can
        };

    })();


})(jQuery);

