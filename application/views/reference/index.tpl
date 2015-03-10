<section>
	<article>
		<div class="wrapper">
			<h1>{$page.nazev}</h1>
			<div class="row">
				<p>{$page.popis}</p>
				{foreach from=$items item=reference key=key name=references}
					<div class="makeMeHalf">
						<a href="{$url_base}{$reference.nazev_seo}">
						 	<h2>{$reference.nazev}</h2>
						 	<img src="{$reference.icon.small}">
				 		</a>
					</div>
				 {/foreach}
			</div>
		</div>
	</article>
</section>

 