<nav class="breadcrumbs wrapper">
	<span><a href="{if $url_homepage!='/index'}{$url_homepage}{else}{$url_base}{/if}">{translate str="Hlavní strana"}</a></span>
	{foreach from=$items item=item key=key name=breadcrumbs}
		 <span><a href="{$url_base}{$item.nazev_seo}">{$item.nazev}</a></span>
	{/foreach}
</nav>