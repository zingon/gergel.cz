<nav class="breadcrumbs wrapper">
	<span><a href="{if $url_homepage!='/index'}{$url_homepage}{else}{$url_base}{/if}">{translate str="Hlavní strana"}</a></span>
	{foreach from=$items item=item key=key name=breadcrumbs}
		{if not empty($item.nazev_seo)}
			<span><a href="{$url_base}{$item.nazev_seo}">{$item.nazev}</a></span>
		{/if}
	{/foreach}
</nav>