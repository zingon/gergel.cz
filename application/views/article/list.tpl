<section>
    <article id="productInfo">
    <section class="wrapper">
        <h1>{$item.nazev}</h1>
		{foreach from=$items item=article key=key name=article_list}
			<section class="wrapper">
	        	<div class="row">
					<div class="col-lg-7">
						<h2><a href="{$article.nazev_seo}">{$article.nazev}</a></h2>
						<p>{$article.uvodni_popis}</p>
					</div>
					<div class="col-lg-5">
						<img src="{$article.photo}">
					</div>
	        	</div>
    		</section>
		{/foreach}
    </section>
    </article>
</section>