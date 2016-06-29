<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <% base_tag %>
    <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>

    <script src="https://use.typekit.net/jyv7peg.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <script type='text/javascript' src='{$ThemeDir}/js/thirdparty/modernizr.js'></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name='twitter:title' content='Student Services - Otago Polytechnic' />
    <meta name='twitter:url' content='$BaseHref' />
    <meta name='twitter:image' content='https://www.op.ac.nz/assets/heromedia/Study.jpg' />
    <meta name='twitter:site' content='@OtagoPolytech' />
    <link rel="icon" type="image/svg+xml" href="themes/otp/logo.svg"/>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon" href="themes/otp/images/apple-touch-icon-iphone.png" /> 
    <link rel="apple-touch-icon" sizes="72x72" href="themes/otp/images/apple-touch-icon-ipad.png" /> 
    <link rel="apple-touch-icon" sizes="114x114" href="themes/otp/images/apple-touch-icon-iphone4.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="themes/otp/images/apple-touch-icon-ipad3.png" />

    $MetaTags(false)

    <link rel='stylesheet' type='text/css' href='{$ThemeDir}/static/otp.min.css'>
    <!--[if lte IE 8]>
     <link rel='stylesheet' type='text/css' href='{$ThemeDir}/static/ie/otp.min.css'>
    <link rel='stylesheet' type='text/css' href='{$ThemeDir}/static/ie.css'>
    <![endif]-->
    <% with $SiteConfig %>
      <!--  tttttttt -->
    <% if $FeedBackLite %>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
	<script type="text/javascript">
	var h = document.getElementsByTagName('head')[0];
	(function(){
	var fc = document.createElement('link'); fc.type = 'text/css'; fc.rel = 'stylesheet';
	fc.href = 'https://product.feedbacklite.com/feedbacklite.css'; h.appendChild(fc);
	})();
	var fbl = {'campaign':{'id':1601, 'type':2, 'size':3, 'position':10, 'tab':1, 'control':1}};
	(function(){
	var fj = document.createElement('script'); fj.type = 'text/javascript';
	fj.async = true; fj.src = 'https://product.feedbacklite.com/feedbacklite.js'; h.appendChild(fj);
	})();
	</script>
    <% end_if %>
    <% end_with %>
</head>
<body class="template_{$ClassName}">
    <% if not $isStage %>
        <!-- Google Tag Manager -->
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KK4TJS"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KK4TJS');</script>
        <!-- End Google Tag Manager -->

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
    <% else %>
            <!-- no google analtics becuase stage  stupid datalayer thing is there because of GTM-->
            <script>
        dataLayer=[];
        </script>
    <% end_if %>
    <!--[if lte IE 8]>
        <div class="unsupported">
            <p>Your web browser in unsupported by Otago Polytech. <a href="http://outdatedbrowser.com/en">Please update your webbrowser</a> for the best experience.</p>
        </div>
    <![endif]-->

    <% include Header %>
    <% include DropdownContents %>
    $Layout

    <% include RelatedTopics %>
    <% include Footer %>
    <% include Scripts %>
</body>
</html>