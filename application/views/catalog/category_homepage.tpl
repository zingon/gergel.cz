<section>
	<article>
		<div class="wrapper">
			<h1>{$item.nazev}</h1>
			<p>{$item.popis}</p>
			<section id="vyrobniKapacityItems" class="row">
				<div class="row-same-height">
					{foreach from=$items item=cat key=key name=categories}
						<div class="col-sm-15">
							<a href="{$url_base}{$cat.nazev_seo}">
								<div>
									<img src="{$cat.photo_detail}" class="img-responsive" alt="{$cat.nazev}"/>
									<span>{$cat.nazev}</span>
								</div>
							</a>
						</div>
					{/foreach}
				</div>
			</div>
		</div>
	</article>
</section>