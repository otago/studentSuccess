<div class='checklist'>
    <div class='container boxed-element component-alignment'>
        <span class='icon icon-cta'></span>
        
        <article class='intro'>
            <% if not HideTitle %>
                <h3>{$Title}</h3>
            <% end_if %>

            <% if $Summary %><p>{$Summary}</p><% end_if %>
        </article>

        <% if $Items %>
        <div class='items'>
            <aside class='index'>
                <ul>
                    <% loop $Items %>
                        <li class='main' data-for='desc-{$ID}'>
                            <span class="total"><span class='icon <% if UseArrow %>arrow<% end_if %>' data-for='$ID-{$Up.ID}'></span> {$Title}</span>
                        </li>

                        <div class="accord desc  desc-{$ID}" data-parent='desc-{$ID}'>
                            <% if $ClassName == 'CheckListCollection' %>        
                                <ul>
                                    <% loop $ListCollectionItems %>
                                        <li data-input = 'input-{$ID}-{$Up.ID}' ><span class='icon icon-dot'></span>{$Content}</li>
                                        <input type="checkbox" class = 'input-{$ID}-{$Up.ID}' name="CollectionItems[{$ID}]" value="1" style='Display:none'>
                                    <% end_loop %>
                                </ul>
                            <% else %>
                                $Content
                            <% end_if %>
                        </div>

                        <input class = 'desc-{$ID}' type="checkbox" name="Items[{$ID}]" value="1" style='Display:none'>
                    <% end_loop %>
                </ul>
            </aside>

            <% loop $Items %>
            <article class='mainlist desc desc-{$ID}' data-parent='desc-{$ID}'>
                <% if $ClassName == 'CheckListCollection' %>
                    <ul>
                        <% loop $ListCollectionItems %>
                        <li data-input = 'input-{$ID}-{$Up.ID}' ><span class='icon icon-dot'></span>{$Content}</li>
						<input type="checkbox" class = 'input-{$ID}-{$Up.ID}' name="CollectionItems[{$ID}]" value="1" style='Display:none'>
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