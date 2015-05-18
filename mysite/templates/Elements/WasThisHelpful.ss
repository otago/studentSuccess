<div class="component-alignment">
    <div class='was-this-helpful' data-id="{$Page.ID}">
        <div class='widget'>
            <p>
                <% if $Text %>{$Text}<% else %>Was this helpful ?<% end_if %>
                <a href='{$YesLink}' class='yes' data-id="{$Page.ID}">Yes</a><a href='{$NoLink}' data-id="{$Page.ID}" class='no'>No</a>
            </p>
        </div>
    </div>
</div>