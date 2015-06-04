<div class='checklist'>
    <div class='container boxed-element component-alignment'>

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
                        <li class='' data-for='desc-{$ID}'><span class='icon'></span> {$Title}</li>
						<input class = 'desc-{$ID}' type="checkbox" name="Items[{$ID}]" value="1" style='Display:none'>
                    <% end_loop %>
                </ul>
            </aside>

            <% loop $Items %>
            <article class='desc desc-{$ID}' data-parent='desc-{$ID}'>
                <% if $ClassName == 'CheckListCollection' %>
                    <ul>
                        <% loop $ListCollectionItems %>
                        <li data-input = 'input-{$ID}' ><span class='icon icon-dot'></span>{$Content}</li>
						<input type="checkbox" class = 'input-{$ID}' name="CollectionItems[{$ID}]" value="1" style='Display:none'>
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