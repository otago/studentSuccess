<% if $HasContactableDetails %>
    <div class='tile fixed fixed-right tile-c content-tile contact-tile right $ExtraClass'>
        <% include OTPContact %>
    </div>
<% else %>
    <% with $SiteConfig %>
    <div class='tile fixed fixed-right tile-c content-tile contact-tile right $ExtraClass otpContactTile'  >
            <% include OTPContact %>
        </div>
    <% end_with %>
<% end_if %>