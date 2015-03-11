{foreach from=$links item=link key=key name=page_boxes}
	<div class="col-sm-4">
		{if $link.icon_src}<a href="{$url_base}{$link.nazev_seo}"><img src="{$link.icon}" class="img-responsive" alt="Konstrukce"/></a>{/if}
		<h4><a href="{$url_base}{$link.nazev_seo}">{$link.nazev}</a></h4>
		<p>{$link.uvodni_popis|truncate:129:"..."|strip_tags:false}</p>
		<a href="{$url_base}{$link.nazev_seo}" class="makeMeButton">{translate str="více"}</a>
	</div>
{/foreach}