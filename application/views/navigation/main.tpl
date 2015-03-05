{foreach from=$links item=link key=key name=menu}
	<a href="{$url_base}{$link.nazev_seo}">{$link.nazev}</a>
{/foreach}