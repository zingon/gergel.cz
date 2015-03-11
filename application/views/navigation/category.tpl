<nav id="vyrobniKapacityItems">
    <div class="wrapper row">
    {foreach from=$links item=link key=key name=Underlinks}
        <div class="col-sm-15">
            <a href="{$url_base}{$link.nazev_seo}">
                <span>{$link.nazev}</span>
            </a>
        </div>
    {/foreach}    
    </div>
</nav>