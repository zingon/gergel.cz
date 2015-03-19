<section>
	<article>
		<div class="wrapper">
			<h1>{$item.nazev}</h1>
			<p>{$item.popis}</p>
			<div class="row">
				<div class="col-xs-12">
					<div class="gallery">
						{foreach from=$item.photos item=photo key=key name=item_photos}
							{if $smarty.foreach.item_photos.index == 0}
								<img src="{$photo.big}" class="img-responsive galleryCanvas" alt="{$photo.nazev}"/>
								<ul class="bxslider bxNormal">
							{/if}
							<li class="slide">
								<a href="{$photo.big}">
								<img src="{$photo.small}" alt="{$photo.nazev}">
								</a>
							</li>
						{/foreach}
						</ul>
					</div>
				</div>	
			</div>
		</div>
	</article>
</section>

