<section>
	<article>
		<div class="wrapper">
			<h1>{$item.nazev}</h1>
			<p>{$item.popis}</p>
			<section id="vyrobniKapacityItems" class="row">
				<div class="row-same-height">
				{foreach from=$item.childrens item=child key=key name=page_childs}
					<div class="col-sm-4 col-sm-height">
						 <a href="{$child.nazev_seo}">
                            <div>
                                <img src="{$child.icon}" class="img-responsive" alt="{$child.nazev}"/>
                                <p>{$child.uvodni_popis|truncate:129:"..."|strip_tags:false}</p>
                                <span>{$child.nazev}</span>
                            </div>
                        </a>
					</div>
				{/foreach}
				</div>
			</section>
		</div>
	</article>
</section>