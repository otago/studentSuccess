<div class="component-alignment boxed-element">
<form class='filter-form form-{$ID}'>
    <div class='filters'>
        <fieldset>
            <div class='subject'>
                <select class="subject-filter">
                    <option value=''><% if $FilterByString %>{$FilterByString}<% else %>Filter by Subject<% end_if %></option>
                    <% loop $Subjects %>
                    <option value='{$Title}'>{$Title}</option>
                    <% end_loop %>

                </select>
            </div>
            <div class='input'>
                <input class="keywords" placeholder='{$SearchFieldDefaultText}'>
            </div>

            <div class='clear'></div>

        </fieldset>
        <div class='actions'>
            <button class='search icon-search icon'></button>
        </div>
    </div>

    <div class='sort-by'>
        <div class='options'>
            <label>Sort by:</label>
            <div class='option-holder'>
                <select class="sort-filter">
                    <option value='order'>Default</option>
                    <option value='views'>Most viewed</option>
                    <option value='title'>Title</option>
                </select>
            </div>
        </div>
        <div class='clear'></div>
    </div>

</form>


<div class='masonry-content clear-this'>
    <div class='packery filters' data-filterform="form-{$ID}">
        <div class='tile tile-c half width-c'></div>
        <% loop $Tiles %>
            $Render
        <% end_loop %>
        <% if $ShowContacts %>
            <% include ContactTile %>
        <% end_if %>
    </div>
</div>