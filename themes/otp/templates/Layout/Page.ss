<% include MiniHero %>



<div class='page-contents<% if not $HeroImage %> no-hero<% end_if %>'>
    <% include Breadcrumbs %>
</div>

<div class="elements-holder">
    $BeforeElementArea

    <div class='page-contents no-hero'>
        <div class='content'>
            <article class='article'>
                $ElementArea
            </article>
            <aside class='sidebar'>
                $SidebarElementArea
            </aside>
        </div>
    </div>
    $AfterElementArea

</div>

