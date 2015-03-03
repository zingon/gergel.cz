{* sablona pro detail novinky) *}
<div id="page-article" class="detail top-shadow">
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
    <article class="row">
        <div class="small-12 column">
            <div class="row">
                <div class="small-12 column">
                    {if $item.photo_src}
                        <img src="{$media_path}photos/article/item/images-{$item.id}/{$item.photo_src}-t2.jpg" alt="{$item.nazev} photo" class="left main">
                    {/if}
                    <time datetime="{$item.date}">{$item.date|date:cz}</time>
                    {if $item.uvodni_popis}
                        <div class="uvodni-popis {if !$item.photo_src}arrow{/if}">
                            {$item.uvodni_popis}
                        </div>
                    {/if}
                    {$item.popis}
                </div>
            </div>
            <div class="row">
                <div class="small-12 column">
                    <a href="{$url_base}{$prev.nazev_seo}" class="button red tiny radius more right">
                        {translate str="zpět"}
                    </a>
                </div>
            </div>
        </div>
    </article>
</div>