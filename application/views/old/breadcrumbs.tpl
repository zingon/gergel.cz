{* sablona drobitkove navigace *}
<nav class="breadcrumbs">
    <a href="{$url_homepage}" class="item">{translate str="Úvod"}</a>
    {foreach from=$items item=item name=bread}
        <a href="{if !isset($item.nazev_seo)}#{else}{$url_base}{$item.nazev_seo}{/if}" class="{if !isset($item.nazev_seo)}unavailable{/if}{if ($url_base|cat:$item.nazev_seo) == $url_actual} current{/if}">{$item.nazev}</a>
    {/foreach}
</nav>