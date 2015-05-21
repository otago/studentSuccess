<!DOCTYPE html>
<html>
    <head>
        <% base_tag %>
        <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
        <script type='text/javascript' src='{$ThemeDir}/js/thirdparty/modernizr.js'></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="x-ua-compatible" content="IE=10"/>
        $MetaTags(false)

        <script src="//use.typekit.net/jyv7peg.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>

        <link rel='stylesheet' type='text/css' href='{$ThemeDir}/static/otp.min.css'>
        <!--[if lte IE 8]>
        <link rel='stylesheet' type='text/css' href='{$ThemeDir}/static/ie/otp.min.css'>
        <![endif]-->
    </head>
<body>
    <% if SiteConfig.GACode %>
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '$SiteConfig.GACode', 'auto');
        ga('send', 'pageview');

        </script>
    <% end_if %>
    
    <% include Header %>
    <% include DropdownContents %>
    $Layout
    <% include RelatedTopics %>
    <% include Footer %>
    <% include Scripts %>
</body>
</html>