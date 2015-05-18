if(typeof app === 'undefined') { var app = {}; }

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
