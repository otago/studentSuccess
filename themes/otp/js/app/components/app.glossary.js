
if(typeof app === 'undefined') { var app = {}; }

(function($){

    app.glossary = (function() {
        var items = $('.glossary-item');

        var searchGlossary = function(){
		

        };

        var can = function(){
            return items.length > 0;
        };

        var init = function (){
            var list = [];
            
            items.each(function(i, elem) {
                if($(elem).find('h4')) {
                    var itemName = $(elem).find('h4').text().replace('(', ' ').replace(')', ' ');
                    console.log(itemName);
                    list.push({
                        "id": i,
                        "name": itemName
                    });
                }
            });

            $(".filter-form").on('submit', function(e) {
                e.preventDefault();

                var input = $(".token-input-input-token-mac input").val();

                items.each(function(i, elem) {
                    var matches = $(elem).text().toLowerCase().indexOf(input.toLowerCase());
                    
                    if(matches != -1) {
                        $(elem).parents('.glossary-letter').show();
                    }
                });

                $('.glossary-letter').filter(':visible').first().find('.title-c a').trigger('click');
            });


            $(".keywords").tokenInput(list, {
                hintText: 'Search by keyword',
                theme: 'mac',
                tokenLimit: 1,
                onAdd: function (item) {
                    // take the user to that accordion item

                    var heading = items.find('h4:contains('+ item.name+')');
                    var container = heading.parents('.glossary-letter');

                    var toggle = container.find('.title-c');

                    if(toggle.hasClass('active')) {
                        $(document).scrollTop(heading.offset().top);  
                    } else {
                        toggle.find('a').trigger('click');

                        setTimeout(function() {
                            $(document).scrollTop(heading.offset().top);
                        }, 500);
                    }
                },
                onDelete: function (item) {
                    $('.glossary-letter').siblings('.glossary-letter').show();
                }
            });
        };

        return {
            'init'			: init,
            'can'			: can
        };

    })();


})(jQuery);