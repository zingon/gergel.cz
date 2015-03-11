<section>
    <article id="productInfo">
	 <section class="wrapper">
    <h1>{$item.nazev}</h1>

    {foreach from=$products item=product key=key name=category_products}
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-6">
                <h2>{$product.nazev}</h2>
                <p>{$product.popis}</p>
                <h3>{translate str="Technické data"}</h3>
                {$product.odborne_informace}
            </div>
            <div class="col-sm-6">
                {foreach from=$product.photos item=photo key=key name=photo}
                {if $smarty.foreach.photo.index == 0}
                <div class="row">
                	<div class="gallery pullRight">
                    	<img src="{$photo.t1}" class="img-responsive"/>
                    </div>
                </div>
                {*<div class="row">*}
                    {/if}
                    {*<div class="makeMeThird">
                        <img src="{$photo.small}">
                    </div>*}
                    {/foreach}
                </div>
            </div>
       {* </div>*}
    </section>
    {/foreach}
	</section>
    </article>
</section>