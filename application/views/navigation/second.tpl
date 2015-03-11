{foreach from=$links item=$link key=key name=name}
	{if $sel_link.nazev_seo eq $link.nazev_seo and not empty($link.children)}
					
	{/if}
{/foreach}
