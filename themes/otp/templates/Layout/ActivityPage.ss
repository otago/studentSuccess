<% include MiniHero %>

<div class='page-contents clear-this'>
    <% include Breadcrumbs %>
</div>

<div class="elements-holder">
	<div class="component-alignment">
    	<section class='page-intro'>
        	<article>
        	    <h1 class='title'>{$Title}</h1>
        	    <% if $Intro %>
        	        <p>{$Intro}</p>
        	    <% end_if %>
        	</article>
    	</section>
	</div>

    $ElementArea
</div>

<div class="component-alignment">
    <div class="container">
        <section id="activity" class="activity" data-validation-method="$Validation">
            <header class="activity_header activity_scheme__{$ColorScheme}">
                <h3>$Title</h3>

                <div class="progress">
                    <ul>
                        <% loop Activities %>
                            <li><a href="#act_{$ID}" <% if First %>class="current"<% end_if %>>$Pos</a></li>
                        <% end_loop %>
                    </ul>
                </div>
            </header>

            <% loop Activities %>
                <article class="activity_individual  activity_{$Presentation} <% if First %>current<% end_if %>" data-activity-id="$ID">
                    <h3>$Title</h3>

                    $Description

                    <% if ActivityOptions.Count > 0 %>
                        <div class="activity_text activity_text__{$Presentation}">
                            <ul>
                             <% loop ActivityOptions %>
                                 <li <% if Up.Presentation == Replace %>contenteditable=true<% end_if %>>$Title</li>
                             <% end_loop %>
                            </ul>
                        </div>
                    <% end_if %>

                    <div class="activity_success">
                        $RightAnswerContent
                    </div>

                    <div class="activity_fail_warning">
                        <p>That is not quite the correct answer please try again.</p>
                    </div>

                    <div class="activity_fail">
                        $WrongAnswerContent
                    </div>

                    <div class="activity_answers">
                        <ul>
                            <% loop Answers %>
                                <li>$Title</li>
                            <% end_loop %>
                        </ul>
                    </div>
                </article>
            <% end_loop %>

            <footer class="activity_navigation">
                <span class="btn next">Start &rarr;</span>
                <span class="btn hidden back">&larr;</span>
            </footer>
        </section>
    </div>
</div>

<% include WasThisHelpful %>