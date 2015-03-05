<nav id="mainNav" class="wrapper">
	<a href="{$url_base}"><img src="{$media_path}img/layout/home.png" alt="" class="home"/></a>
	<div class="nav">
		{foreach from=$links item=link key=key name=menu}
			{if $link.nazev_seo!='index'}
				<a href="{$url_base}{$link.nazev_seo}">{$link.nazev}</a>
			{/if}
		{/foreach}
	</div>
</nav>