<h1>{$item.nazev}</h1>
<p>{$item.popis}</p>
<img src="{$item.photo.small}">
{foreach from=$item.photos item=photo key=key name=item_photos}
	<img src="{$photo.small}" alt="{$photo.nazev}">
{/foreach}