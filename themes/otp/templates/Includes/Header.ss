<header class='main'>
    <div class='container'>
        <h1 class='logo'><a href='{$BaseHref}'>
            <img src='{$ThemeDir}/images/logo.svg' title="{$SiteConfig.Title}">
        </a></h1>

        <nav>

            <% if $TopMenu %>
            <ul class='level-1'>
                <li class='right'>
                    <form action="{$BaseHref}search">
                        <input type='text' name='Search' placeholder='Search'>
                        <button class='icon icon-search'></button>
                    </form>
                </li>
                <% loop $TopMenu %>
                    <li<% if $AlignRightTopMenu %> class='right'<% end_if %>>
                        <a href='{$Link}'<% if $LinkOrSection == 'section' %>class='active'<% end_if %>>{$MenuTitle}</a>
                    </li>
                <% end_loop %>
            </ul>
            <% end_if %>

            <ul class='level-2'>
                <% loop $Menu(1) %>
                <li <% if $HasDropdownContents %>class="has_dropdown"<% end_if %>>
                    <a href='{$Link}' class='{$NavigationClass}'>{$MenuTitle.XML}</a>
                    <% if $HasDropdownContents %>
                        <span class='drop-down-span' data-target='.info-{$ID}'>
						<img src='{$ThemeDir}/images/icons/down.svg'>
					</span>
                    <% end_if %>
                </li>
                <% end_loop %>
            </ul>

            <a href='#' class='hamburger icon icon-hamburger'></a>

        </nav>
    </div>

</header>