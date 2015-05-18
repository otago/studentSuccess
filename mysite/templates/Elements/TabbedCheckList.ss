<% if $Tabs %>
<div class='tabbed-content'>

    <section class="tab-index container">

        <div class="container">
            <ul>
                <% loop $Tabs %>
                    <li<% if $First %> class="active"<% end_if %> data-for="tab-{$ID}">{$Title}</li>
                <% end_loop %>
            </ul>
        </div>

    </section>

    <% loop $Tabs %>
    <section class="tab-section tab-{$ID}<% if $First %> active<% end_if %>">
        <% loop $Blocks %>

        <div class="content-block {$Color}">
            <div class="container">
                <h4 class="title">{$Title}</h4>
            </div>
            <% if $Items %>
            <ul class="itemList accordion-c">
                <% loop $Items %>
                <li class="checkable">
                    <h2 class='title-c'><a href='#'><span class="icon icon-tick"></span>{$Title}</a></h2>
                    <div class='accordion-item'>
                        <% if $ShowContacts %>
                            <div class="col left">
                                {$Content}
                            </div>
                            <div class="col right">
                                <% include MiniContactBlock %>
                            </div>
                        <% else %>
                            $Content
                        <% end_if %>
                    </div>
                </li>
                <% end_loop %>

            </ul>
            <% end_if %>
        </div>
        <% end_loop %>



    </section>
    <% end_loop %>


</div>
<% end_if %>