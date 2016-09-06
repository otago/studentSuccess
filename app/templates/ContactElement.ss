<% if $Widget %>
    <% with $Widget %> 
    <section class='left-content contactElement ceSection clear-this <% if $Image %>has-image<% end_if %>'>
            <div class=" contactElementboxed-element">
                <% if $Image %>
                            <div class="col left $imageType hide_on_mobile">
                                    $Image.CroppedImage(125, 125)
                                    
                            </div>
           
                    <% end_if %>

                    <div class="col right">
                            <% if $FirstName %>
                                    <span class='ceTitle'>{$FirstName} {$LastName}</span>
                            <% end_if %>
                            <% if $DescriptionText %>
                                    <p>
                                        {$DescriptionText} 
                                    </p>
                                    
                                    <% if $email %>
                                    <p>
                                    Contact $FirstName 
                                    <br><a href='mailto:$email' >$email</a>
                                    </p>
                                    <% end_if %>
                            <% end_if %>

                    </div>

                    
            </div>
    </section>
    <% end_with %>
<% else %>
<section class='cta {$Color} clear-this <% if $Image %>has-image<% end_if %>'>
            <div class="component-alignment boxed-element">
                    <div class="col left">
                            <% if $Icon %>
                                    <span class='icon $Icon'></span>
                            <% end_if %>
                            <% if $DisplayTitle %>
                                    <h3>{$DisplayTitle}</h3>
                            <% end_if %>
                            <% if $DescriptionText %>
                                    <p>
                                            {$DescriptionText} 
                                    </p> 
                            <% end_if %>
                            <% if $Link && $ButtonText %>
                            <a href='{$Link}' <% if Target =="_modal" %>class="fancybox-link" data-fancybox-type="ajax"<% else %>target={$Target}<% end_if %> <% if ForceDownload %>download="$Link"<% end_if %>>{$ButtonText}</a>
                            <% end_if %>
                    </div>

                    <% if $Image %>
                            <div class="col image hide_on_mobile">
                                    $Image
                            </div>
                    <% end_if %>
            </div>
    </section>
<% end_if %>