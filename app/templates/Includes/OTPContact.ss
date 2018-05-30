<style>
   .OTPLinkList  .OTPcontactClass{
          
        position: relative;
        top: 50%;
        transform: perspective(1px) translateY(-48%);
        
    }
    .OTPLinkList .OTPcontactClass{
        padding-left: 22px;
    }
    .otpContactTile .OTPcontactClass{
        margin-left: -10px; 
    }
</style>
<div class="OTPcontactClass" ><% if $ContactBoxTitle %><h3 style="margin-top: -10px">{$ContactBoxTitle}</h3><% end_if %>
$ContactBoxSubTitle
<p class='lines'>
    <% if $ContactBoxLocationName %><strong>{$ContactBoxLocationName}</strong><% end_if %><br>
    <% if $ContactBoxLocation %>{$ContactBoxLocation}<% end_if %>
    <% if $ContactBoxPhone %><a style="margin-bottom: auto;" href='tel:{$ContactBoxPhone}'><span class='icon icon-phone' ></span>{$ContactBoxPhone}</a><% end_if %>
    <% if $ContactBoxEmail %><a style="margin-bottom: auto;"  href='mailto:{$ContactBoxEmail}'><span class='icon icon-mail' ></span>{$ContactBoxEmail}</a><% end_if %>
</p>
<p class='lines'>
    <% if $ContactBoxLocationName2 %><strong>{$ContactBoxLocationName2}</strong><% end_if %><br>
    <% if $ContactBoxLocation2 %>{$ContactBoxLocation2}<% end_if %>
    <% if $ContactBoxPhone2 %><a style="margin-bottom: auto;" style="margin-bottom: auto;" href='tel:{$ContactBoxPhone2}'><span class='icon icon-phone'></span>{$ContactBoxPhone2}</a><% end_if %>
    <% if $ContactBoxEmail2 %><a style="margin-bottom: auto;" href='mailto:{$ContactBoxEmail2}'><span class='icon icon-mail' ></span>{$ContactBoxEmail2}</a><% end_if %>
</p>
<p class='lines'>
    <% if $ContactBoxLocationName3 %><strong>{$ContactBoxLocationName3}</strong><% end_if %><br>
    <% if $ContactBoxLocation3 %>{$ContactBoxLocation3}<% end_if %>
    <% if $ContactBoxPhone3 %><a style="margin-bottom: auto;" href='tel:{$ContactBoxPhone3}'><span class='icon icon-phone' ></span>{$ContactBoxPhone3}</a><% end_if %>
    <% if $ContactBoxEmail3 %><a style="margin-bottom: auto;" href='mailto:{$ContactBoxEmail3}'><span class='icon icon-mail' ></span>{$ContactBoxEmail3}</a><% end_if %>
</p>

</div>