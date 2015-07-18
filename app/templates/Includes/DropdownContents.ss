<% loop $Menu(1) %>
    <% if $HasDropdownContents %>
        <section class='drop-menu info-{$ID}'>
            <div class='container'>

                <div class='left'>
                    <% if $DropDownMenuTitle %><h3>{$DropDownMenuTitle}</h3><% end_if %>
                    <% if $DropDownCol1 %><section class='col'>{$DropDownCol1}</section><% end_if %>
                    <% if $DropDownCol2 %><section class='col'>{$DropDownCol2}</section><% end_if %>
                    <% if $DropDownCol3 %><section class='col'>{$DropDownCol3}</section><% end_if %>

                </div>
                <% if $DropDownImage %>
                <div class='right'>
                    <% if $DropDownLink || DropDownPage %><a href='<% if DropDownPage %>$DropDownPage.Link<% else %>$DropDownLink<% end_if %>' <% if DropDownTarget %>target="$DropDownTarget"<% end_if %>><% end_if %>
                        {$DropDownImage.Add(298, 395)}
                        <% if DropDownImageText %><span class="dropdowntext">
                        $DropDownImageText
                        </span>
                        <% end_if %>
                    <% if $DropDownLink || DropDownPage %></a><% end_if %>
                </div>
                <% end_if %>

            </div>

        </section>
    <% end_if %>
<% end_loop %>