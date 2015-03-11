<nav id="mainNav" class="wrapper">
	<a href="{$url_base}{if $index_link.nazev_seo!= 'index'}{$index_link.nazev_seo}{/if}"><img src="{$media_path}img/layout/home.png" alt="{$index_link.nazev}" class="{$index_link.nav_class}"/></a>
	<div class="nav">
		{foreach from=$links item=link key=key name=menu}
				<a href="{$url_base}{$link.nazev_seo}">{$link.nazev}</a>
		{/foreach}
	</div>
</nav>
