/**
 * Created by nivankafonseka on 5/14/14.
 */
(function($) {
    $.entwine('ss', function($){
        $("select[name=LinkType]").entwine({
            onmatch: function() {
                updateLinkableFormFields();
            },
            onload: function() {
                updateLinkableFormFields();
            },
            onclick: function() {
                this.toggle();
            },
            onchange: function() {
                updateLinkableFormFields();
            }
        });

        function updateLinkableFormFields(){
            if($("select[name=LinkType]").val() == 'External') {
                $('#InternalLinkID').hide();
                $('#ExternalLink').show();

            } else if($("select[name=LinkType]").val() == 'Internal') {
                $('#InternalLinkID').show();
                $('#ExternalLink').hide();

            }
        };

    });
})(jQuery);

