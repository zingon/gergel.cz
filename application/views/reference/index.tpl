 <h1>{$page.nazev}</h1>
 <p>{$page.popis}</p>
 {foreach from=$items item=reference key=key name=references}
 	<a href="{$url_base}{$reference.nazev_seo}">
	 	<h2>{$reference.nazev}</h2>
	 	<img src="{$reference.icon.small}">
 	</a>
 {/foreach}