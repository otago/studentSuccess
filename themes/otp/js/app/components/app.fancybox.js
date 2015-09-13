if(typeof app === 'undefined') { var app = {}; }

(function($){

    app.fancybox = (function() {
        var items = $('.fancybox-link');

        var initFancyBox = function() {
            items.fancybox({
                openEffect : 'none',
                closeEffect : 'none',
                prevEffect : 'none',
                padding: 0,
                nextEffect : 'none',
                minWidth: 320,
                minHeight: 320,
                arrows : false,
                helpers : {
                    media : true,
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

            items.click(function(e) {
                e.preventDefault();
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

