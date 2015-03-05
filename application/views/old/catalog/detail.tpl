<div id="page-catalog" class="top-shadow detail">
    <header class="row-full">
        <div class="row">
            <div class="small-4 medium-6 column">
                <h1>{$item.nazev}</h1>
            </div>
            <div class="small-8 medium-6 column text-right">
                {widget action="breadcrumbs" controller="navigation" }
            </div>
        </div>
    </header>
    <div class="row">
        <div class="medium-4 columns">
            {widget controller=catalog action=second_subnav}
        </div>
        <div class="medium-8 columns">
            {if $item.sec_src}
                <aside class="main-photo display-table">
                    <div class="display-row">
                        <div class="display-cell">
                            <img src="{$media_path}photos/catalog/category/images-{$item.id}/{$item.sec_src}-t2.png" alt="{$item.nazev} photo">
                        </div>
                    </div>
                </aside>
            {/if}
            <p class="uvodni-popis">{$item.uvodni_popis}</p>
            {$item.popis}
            <div class="row">
                <div class="small-12 column">
                    <a href="{$url_base}{$prev.nazev_seo}" class="button red tiny radius more right">
                        {translate str="zpět"}
                    </a>
                </div>
            </div>
            {if $item.contact_form}
                <div class="row">
                    <div class="small-12 column">
                        <h3>{translate str="Kontaktní formulář"}</h3>
                        {widget controller=contact action=show}
                    </div>
                </div>
            {/if}
        </div>
    </div>
</div>