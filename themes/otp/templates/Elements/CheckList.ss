<div class='checklist'>
    <div class='container'>

        <span class='icon {$Icon}'></span>
        <article class='intro'>
            <h3>{$DisplayTitle}</h3>
            <% if $Summary %><p>{$Summary}</p><% end_if %>
        </article>

        <% if $Items %>
        <div class='items'>
            <aside class='index'>
                <ul>
                    <% loop $Items %>
                        <li class='' data-for='desc-{$ID}'><span class='icon {$Icon}'></span> {$Title}</li>
                    <% end_loop %>
                </ul>
            </aside>

            <% loop $Items %>
            <article class='desc desc-{$ID}'>
                <% if $ClassName == 'CheckListCollection' %>
                    <ul>
                        <% loop $ListCollectionItems %>
                        <li><span class='icon {$Icon}'></span>{$Content}</li>
                        <% end_loop %>
                    </ul>
                <% else %>
                    $Content
                <% end_if %>
            </article>
            <% end_loop %>


        </div>
        <% end_if %>

    </div>
</div>