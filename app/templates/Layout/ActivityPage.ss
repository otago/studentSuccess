<% include MiniHero %>

<div class='page-contents clear-this'>
    <% include Breadcrumbs %>
</div>

<div class="elements-holder">
	<div class="component-alignment">
        <% include PageIntro %>
	</div>

    $ElementArea
</div>

<div class="component-alignment">
    <div class="container">
        <a class="fancybox-link activities-trigger" href="#activity"></a>

        <section id="activity" class="activity modal-content" data-validation-method="$Validation" data-max-attempts="$MaxAttempts">
            <header class="activity_header activity_scheme__{$ColorScheme}">
                <% if $Icon == "pencil" %>
                    <div class="preicon"><% include PencilIcon %></div>
                <% else_if $Icon == "question" %>
                    <div class="preicon question">?</div>
                <% end_if %>

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

                    <% if Description %>
                        <div class="activity_description">
                            $Description
                        </div>
                    <% end_if %>

                    <% if ActivityOptions.Count > 0 %>
                        <div class="activity_text activity_text__{$Presentation}">
                            <% if Presentation == "DragAndDropToMatch" %>
                                <ul class="labels">
                                    <% loop MatchLabels %>
                                        <li>$Title</li>
                                    <% end_loop %>
                                </ul>
                            <% end_if %>
                            <ul>
                             <% loop ActivityOptions %>
                                 <li <% if Up.Presentation == Replace && IsReplaceable %>class="replaceable" contenteditable=true<% end_if %>>$Title</li>
                             <% end_loop %>
                            </ul>
                        </div>
                    <% end_if %>

                    <div class="activity_success">
                        $RightAnswerContent
                    </div>

                    <div class="activity_fail_warning">
                        $WarningContent
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
                <span class="btn next"><% if Activities.First.ClassName == "TextSlide" %>Start<% else %>Next<% end_if %> &rarr;</span>
                <span class="btn hidden back">&larr;</span>
            </footer>
        </section>
    </div>
</div>

<% include WasThisHelpful %>