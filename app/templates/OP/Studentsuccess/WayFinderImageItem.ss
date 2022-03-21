<% if $Link %>
	<a class='{$Size} col career-handbook tile' href='{$Link}' target="{$Target}" <% if ForceDownload %>download="$Link"<% end_if %>>
<% else %>
	<section class='{$Size} col career-handbook tile'>
<% end_if %>
    {$Image}
    <% if $Icon %><span class='icon {$Icon}'></span><% end_if %>
    <article>
        <h3>{$Title}</h3>
        <% if $Description %><p>
            {$Description}
        </p><% end_if %>
    </article>
<% if $Link %>
	</a>
<% else %>
	</section>
<% end_if %>