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
<% end_if %>