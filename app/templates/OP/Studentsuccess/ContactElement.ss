<section class='left-content contactElement ceSection clear-this <% if $Image %>has-image<% end_if %>'>
            <div class=" contactElementboxed-element {$backgroundColour}">
                <% if $Image %>
                            <div class="col left $imageType hide_on_mobile">
                                    $Image.Fill(125, 125)
                                    
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
                                    <br><a href='mailto:$email' >$email</a> $Phone
                                    </p>
                                    <% end_if %>
                            <% end_if %>

                    </div>

                    
            </div>
    </section>
