<!DOCTYPE html>
<html lang="en">
<head>
    <% base_tag %>
    <meta charset=utf-8 />
    <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="silverstripe-core/css/security.css">
</head>
<body class="security">
<div class='SecurityHolder'>
    <h1><img src='framework/admin/images/logo_small.png' />$SiteConfig.Title - <span>$Title</span></h1>
    <% if $Form %>
        $Form
    <% else %>
        <div class="error-message">
            <p>Whoops! there is something wrong. Please try again.</p>
        </div>
    <% end_if %>
</div>
</body>
</html>
