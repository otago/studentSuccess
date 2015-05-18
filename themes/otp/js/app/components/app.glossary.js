
if(typeof app === 'undefined') { var app = {}; }

(function($){

    app.glossary = (function(){

        var items = $('.glossary-search');
        var letters = $('.glossary-letter');
        var entries = $('.glossary-item');
        var keyword = $('#glossary-keyword');

        var searchGlossary = function(){

            var searchTerm = keyword.val();
            searchTerm.toLowerCase();
            letters.show();
            entries.show();

            if(searchTerm){


                var words = searchTerm.split(" ");

                letters.each(function(){
                    var letter = $(this);
                    var terms = letter.find('.glossary-item');
                    var bFound = false;

                    terms.each(function(){
                        var title = $(this).find('h4.title');
                        var text = title.text().toLowerCase();
                        var bWordMatched = false;

                        for(var i in words){
                            if(text.indexOf(words[i]) >= 0){
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


})(jQuery);