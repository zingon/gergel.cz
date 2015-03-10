<div id="page-catalog" class="top-shadow list">
    <header class="row-full">
        <div class="row">
            <div class="small-6 column">
                <h1>{$item.nadpis}</h1>
            </div>
            <div class="small-6 column text-right">
                {widget action="breadcrumbs" controller="navigation" }
            </div>
        </div>
    </header>
    <div class="row">
        <div class="small-12 column">
            <ul class="medium-block-grid-4 small-block-grid-2" id="product-list">
                {foreach $items as $product}
                    <li class="text-center">
                        {if $product.photo_src}
                            <div class="photo display-table">
                                <div class="display-row">
                                    <a href="{$url_base}{$product.nazev_seo}">
                                        <img src="{$media_path}photos/catalog/category/images-{$product.id}/{$product.photo_src}-t1.png" alt="{$product.nazev}" data-white="{$media_path}photos/catalog/category/images-{$product.id}/{$product.photo_src}-t1.png" data-red="{$media_path}photos/catalog/category/images-{$product.id}/{$product.sec_src}-t1.png">
                                    </a>
                                </div>
                            </div>
                        {/if}
                        <h3 class="text-center">{$product.nazev}</h3>
                        <p class="text-justify">{$product.uvodni_popis}</p>
                        <a href="{$url_base}{$product.nazev_seo}" class="button red radius small no-border more">
                            {translate str="detail"}
                        </a>
                    </li>
                {/foreach}
            </ul>
        </div>
    </div>
</div>