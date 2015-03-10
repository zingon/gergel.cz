<h1>{translate str="Novinky"}</h1>
{foreach from=$items item=article key=key name=articles}
	<div class="row newsItem">
		<div class="col-xs-4">
			<img src="{$article.photo}">
		</div>
		<div class="col-xs-8">
			<h2>{$article.nazev}</h2>
			<p>{$article.uvodni_popis}</p>
			<a href="{$url_base}{$article.nazev_seo}" class="makeMeButton">{translate str="více"}</a>
		</div>
	</div>
{/foreach}
