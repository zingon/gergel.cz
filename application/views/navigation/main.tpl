{foreach from=$links item=link key=key name=menu}
	<a href="{$url_base}{if $link.nazev_seo!='index'}{$link.nazev_seo}{/if}">{$link.nazev}</a>
{/foreach}