{* sablona pro zobrazeni vysledku vyhledavani *}
<section id="page-search">
    <header class="row">
        <div class="medium-5 medium-push-7 columns medium-text-right">
            {widget action="breadcrumbs" controller="navigation" }
        </div>
        <div class="medium-7 medium-pull-5 columns">
            <h2>{$item.nadpis} <small>{$keyword}</small></h2>
        </div>
    </header>
    <article class="row">
        <div class="small-12 column">
            {$item.popis}
        </div>
    </article>
    <section id="results" class="row">
        <div class="small-12 column">
            {if !empty($search_results)}
                <dl class="tabs" data-tab>
                    {foreach name=search_res from=$search_results key=key item=module_item}
                        <dd {if $smarty.foreach.search_res.iteration == 1}class="active"{/if}>
                            <a href="#panel{$smarty.foreach.search_res.iteration}">{translate str=$key}</a>
                        </dd>
                    {/foreach}
                </dl>
                <div class="tabs-content">
                    {foreach name=search_res from=$search_results key=key item=module_item}
                        <div class="content {if $smarty.foreach.search_res.iteration == 1}active{/if}" id="panel{$smarty.foreach.search_res.iteration}">
                        {foreach name=it from=$module_item key=key item=item}
                            <li>
                                <a href="{$url_base}{if isset($item.template.template) && $item.template.template}{$item.template.nazev_seo}#{/if}{$item.nazev_seo}">{$item.title}</a>
                                - {$item.text|@strip_tags|truncate:210}
                                <a href="{$url_base}{$item.nazev_seo}" title="detail">detail &raquo;</a>
                            </li>
                        {/foreach}
                        </div>
                    {/foreach}
                </div>
                <ul>
            {/if}
            {$search_message}
        </div>
    </section>
</section>

