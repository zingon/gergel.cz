{foreach from=$items item=article key=key name=articles}
	
	<img src="{$article.photo}">
	{$article.nazev}
	{$article.uvodni_popis}
	<a href="{$url_base}{$article.nazev_seo}">Více</a>
{/foreach}