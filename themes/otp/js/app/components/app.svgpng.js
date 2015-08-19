if(typeof app === 'undefined') { var app = {}; }

(function($) {
    app.svgpng = (function() {
        var can = function() {
            var Modernizr = Modernizr || undefined;
            return (typeof Modernizr !== "undefined" && !Modernizr.svg);
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


})(jQuery);