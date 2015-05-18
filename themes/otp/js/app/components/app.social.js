if(typeof app === 'undefined') { var app = {}; }
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


})(jQuery);