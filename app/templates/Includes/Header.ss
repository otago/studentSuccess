<header class='main'>
    <div class='container'>
        <h1 class='logo'><a href='{$BaseHref}'>
            <img src='{$ThemeDir}/images/1logo-stacked.svg' title="{$SiteConfig.Title}">
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

            <a href='#' class='hamburger'>
                <svg class="inline-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="32px" height="32px" viewBox="0 0 32 22.5" enable-background="new 0 0 32 22.5" xml:space="preserve">
                    <g class="svg-menu-toggle">

                    <path class="bar" fill="#ffffff" d="M20.945,8.75c0,0.69-0.5,1.25-1.117,1.25H3.141c-0.617,0-1.118-0.56-1.118-1.25l0,0
                        c0-0.69,0.5-1.25,1.118-1.25h16.688C20.445,7.5,20.945,8.06,20.945,8.75L20.945,8.75z">
                    </path>
                    <path class="bar" fill="#ffffff" d="M20.923,15c0,0.689-0.501,1.25-1.118,1.25H3.118C2.5,16.25,2,15.689,2,15l0,0c0-0.689,0.5-1.25,1.118-1.25 h16.687C20.422,13.75,20.923,14.311,20.923,15L20.923,15z">
                    </path>
                    <path class="bar" fill="#ffffff" d="M20.969,21.25c0,0.689-0.5,1.25-1.117,1.25H3.164c-0.617,0-1.118-0.561-1.118-1.25l0,0
                        c0-0.689,0.5-1.25,1.118-1.25h16.688C20.469,20,20.969,20.561,20.969,21.25L20.969,21.25z">
                    </path>
                    <!-- needs to be here as a 'hit area' -->
          <rect width="32" height="22" fill="none">

                    </rect>
                    </g>
                </svg>
            </a>

        </nav>
    </div>

</header>
