<div class="row" id="article-widget-list">
    <div class="small-12 column">
        <div class="row">
            <div class="small-8 columns">
                <h2>{translate str="Aktuální novinky"}</h2>
            </div>
            <div class="small-4 columns">
                <a href="{$url_base}aktualni-novinky" class="button red radius tiny right continue">
                    {translate str="SEZNAM NOVINEK"}
                </a>
            </div>
        </div>
        <div class="row list">
            <div class="small-12 column">
                <ul class="medium-block-grid-2 small-block-grid-1">
                    {foreach from=$items item=item}
                        <li>
                            <div>
                                {$item.nazev}
                                <a href="{$url_base}{$item.nazev_seo}" class="button red tiny radius more right">
                                    {translate str="více"}
                                </a>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>
</div>