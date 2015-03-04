{* sablona seznamu clanku*}
<div id="page-article" class="list top-shadow">
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
            {if count($items) > 0}
                {foreach name=art from=$items key=key item=item}
                    <article class="row">
                        {if $item.photo_src}
                            <div class="small-2 columns">
                                <img src="{$media_path}photos/article/item/images-{$item.id}/{$item.photo_src}-t1.jpg" alt="{$item.nazev} photo">
                            </div>
                        {/if}
                        <div class="small-{if $item.photo_src}10{else}12{/if} column">
                            <div class="row">
                                <div class="small-8 columns">
                                    <a href="{$url_base}{$item.nazev_seo}"><h4>{$item.nazev|upper}</h4></a>
                                </div>
                                <div class="small-4 columns text-right">
                                    <time datetime="{$item.date}">{$item.date|date:cz}</time>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 columns">
                                    {$item.uvodni_popis}
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 column text-right">
                                    <a href="{$url_base}{$item.nazev_seo}" class="button red tiny radius more right">
                                        {translate str="více"}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                {/foreach}
                {$pagination}
            {/if}
        </div>
    </div>
</div>


