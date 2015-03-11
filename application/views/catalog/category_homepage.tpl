<section>
	<article>
		<div class="wrapper">
			<h1>{$item.nazev}</h1>
			<div class="row">
				{$item.popis}
				{foreach from=$items item=cat key=key name=categories}
					<div class="makeMeAFifth">
						<a href="{$url_base}{$cat.nazev_seo}">
							<img src="{$cat.photo_detail}"><br>
							{$cat.nazev}
						</a>
					</div>
				{/foreach}
			</div>
		</div>
	</article>
</section>