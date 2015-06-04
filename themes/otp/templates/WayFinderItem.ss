<% if $Link %>
	<a class='col {$Size} {$Background} tile' href='{$Link}' target="{$Target}" >
<% else %>
	<article class='col {$Size} {$Background} tile'>
<% end_if %>
    <% if $Icon %><span class='icon {$Icon}'></span><% end_if %>
    <h2>{$Title}</h2>
    <% if $Description %><p>
        {$Description}
    </p><% end_if %>
<% if $Link %>
	</a>
<% else %>
	</article>
<% end_if %>