{foreach from=$links item=link key=key name=page_boxes}
	{$link.nazev}<br>
	{if $link.icon_src}
		<img src={$link.icon}>
	{/if}
	
	{$link.uvodni_popis}<br>
{/foreach}