<section>
    <article id="productInfo">
	 <section class="wrapper">
    <h1>{$item.nazev}</h1>

    {foreach from=$products item=product key=key name=category_products}
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-7">
                <h2>{$product.nazev}</h2>
                <p>{$product.popis}</p>
                <h3>{translate str="Technické data"}</h3>
                {$product.odborne_informace}
            </div>
            <div class="col-lg-5">
                <div class="productGallery">

                    {foreach from=$product.photos item=photo key=key name=photo}
                        {if $smarty.foreach.photo.index == 0}
                            <img src="{$photo.t1}" class="img-responsive" alt="{$photo.nazev}"/>
                            <ul class="bxslider small">
                        {/if}
                        <li>
                            <a href="{$photo.t1}">
                                <img src="{$photo.small}" alt="{$photo.nazev}"/>
                            </a>
                        </li>
                    {/foreach}
                        </ul>
                    </div>
                </div>
            </div>
       {* </div>*}
    </section>
    {/foreach}
	</section>
    </article>
</section>