<div class="row" id="catalog-widget">
    <div class="small-12 column">
        {if !empty($products)}
            <div class="jcarousel-wrapper">
                <div class="jcarousel">
                    <ul id="product-list">
                        {foreach from=$products item=product name=for_p}
                            <li data-equalizer>
                                <span class="number">
                                    {$smarty.foreach.for_p.iteration|romanic}.
                                </span>
                                <a href="{$url_base}{$product.nazev_seo}"><h4>{$product.nazev|upper}</h4></a>
                                {if $product.photo_src}
                                    <div class="photo display-table">
                                        <div class="display-row">
                                            <a href="{$url_base}{$product.nazev_seo}">
                                                <img src="{$media_path}photos/catalog/category/images-{$product.id}/{$product.sec_src}-t1.png" alt="{$product.nazev}" data-red="{$media_path}photos/catalog/category/images-{$product.id}/{$product.sec_src}-t1.png" data-white="{$media_path}photos/catalog/category/images-{$product.id}/{$product.photo_src}-t1.png">
                                            </a>
                                        </div>
                                    </div>
                                {/if}
                                <p class="text-justify" data-equalizer-watch>{$product.uvodni_popis}</p>
                                <a href="{$url_base}{$product.nazev_seo}" class="button red radius small no-border">
                                    {translate str="MÁM ZÁJEM O INFORMACE"}
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                </div>

                <a href="#" class="jcarousel-control-prev jcarousel-control">
                    <img src="{$media_path}img/left-big-arrow.png" alt="{translate str="předchozí"}">
                </a>
                <a href="#" class="jcarousel-control-next jcarousel-control">
                    <img src="{$media_path}img/right-big-arrow.png" alt="{translate str="další"}">
                </a>
            </div>
        {/if}
    </div>
</div>