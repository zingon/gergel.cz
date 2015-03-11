<section>
	<article>
		<div class="wrapper">
			<h1>{$item.nazev}</h1>
			<div class="row">
				{$item.popis}
				{foreach from=$products item=product key=key name=category_products}
					<div class="makeMeHalf">
						<h2>{$product.nazev}</h2>
						<p>{$product.popis}</p>
						{$product.odborne_informace}
					</div>
					<div class="makeMeHalf">
					{foreach from=$product.photos item=photo key=key name=photo}
						{if $smarty.foreach.photo.index == 0}
							<div class="row">
								<img src="{$photo.big}">
							</div>
							<div class="row">
						{/if}
						<div class="makeMeThird">
							<img src="{$photo.small}">
						</div>
					{/foreach}
						</div>
					</div>
				{/foreach}
			</div>
		</div>
	</article>
</section>