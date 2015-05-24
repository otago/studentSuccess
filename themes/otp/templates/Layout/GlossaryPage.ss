<div class="glossary">
    <% include MiniHero %>

    <div class='page-contents'>
        <% include Breadcrumbs %>

        <div class='page-intro main glossary'>
            <h1>$Title</h1>

            <% if $Intro %>
                <p>{$Intro}</p>
            <% end_if %>

            <div class="search-form">
                <form class="glossary-search">
                    <fieldset>
                        <div id="Search" class="field text">
                            <div class="middleColumn">
                                <input type="text" name="search" class="text" id="glossary-keyword" placeholder="Search by keyword">
                            </div>
                        </div>
                        <input type="submit" name="" value="search" class="submit">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    
    <% if $GlossaryTypes %>
    <div class='tabbed-content clear-this'>
        <section class="tab-index container">
            <div class="container">
                <ul>
                    <% loop $GlossaryTypes %>
                    <li<% if $First %> class="active"<% end_if %> data-for="tab-{$ID}">{$Title}</li>
                    <% end_loop %>
                </ul>
            </div>
        </section>

        <% loop $GlossaryTypes %>
        <section class="tab-section tab-{$ID} <% if $First %>active<% end_if %>">
            <% if $Letters %>
             <div class="content-block block1">
                <ul class="itemList accordion-c">
                    <% loop $Letters %>
                    <li class="glossary-letter">
                        <h2 class='title-c'><a href='{$Letter}'>{$Letter}</a></h2>
                        <div class='accordion-item'>
                            <% loop $Items %>
                                <article class="glossary-item">
                                    <% if $ShowContactInfo %>
                                        <div class="col left">
                                            <h4 class="title"><a href="#">{$Title}</a></h4>
                                            <div class="small-text">
                                                {$Content}
                                            </div>
                                        </div>
                                        <div class="col right">
                                            <% include MiniContactBlock %>
                                        </div>

                                    <% else %>

                                        <h4><a href="#">{$Title}</a></h4>
                                        <div class="small-text">
                                            {$Content}
                                        </div>

                                    <% end_if %>
                                </article>
                            <% end_loop %>


                        </div>
                    </li>
                    <% end_loop %>

                </ul>
            </div>
            <% end_if %>
        </section>
        <% end_loop %>


    </div>
    <% end_if %>
</div>

<% include WasThisHelpful %>