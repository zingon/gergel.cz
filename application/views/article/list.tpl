<section>
    <article id="productInfo" class="wrapper">
        <h1>{$item.nazev}</h1>
		{foreach from=$items item=article key=key name=article_list}
			<section>
	        	<div class="row">
					<div class="col-lg-7">
						<h2><a href="{$url_base}{$article.nazev_seo}">{$article.nazev}</a></h2>
						<p>{$article.uvodni_popis}</p>
					</div>
					<div class="col-lg-5">
						<img src="{$article.photo}">
					</div>
	        	</div>
    		</section>
		{/foreach}
		<div class="row">
			<div class="col-lg-12 makeMeCenter">
				{$pagination}
			</div>
		</div>
    </article>
</section>