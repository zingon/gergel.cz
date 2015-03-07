{foreach from=$links item=link key=key name=page_boxes}
	<div class="makeMeThird">
		{if $link.icon_src}<a href="{$url_base}{$link.nazev_seo}"><img src="{$link.icon}" alt="Konstrukce"/></a>{/if}
		<h4><a href="{$url_base}{$link.nazev_seo}">{$link.nazev}</a></h4>
		<p>{$link.uvodni_popis}</p>
		<a href="{$url_base}{$link.nazev_seo}" class="makeMeButton">{translate str="více"}</a>
	</div>
{/foreach}