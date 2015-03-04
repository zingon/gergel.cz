{* sablona hlavni navigace *}

<ul>
  {foreach name=lnk from=$links key=key item=link}
  <li>
    <a href="{if $link.url}{$link.url}{else}{$url_base}{$link.nazev_seo}{/if}" {if !$link.nazev_seo}accesskey="2"{/if} tabindex="{$smarty.foreach.lnk.iteration+3}" {if array_key_exists($link.nazev_seo, $sel_links) || in_array($link.page_type, $sel_links) || ($link.nazev_seo=="" && $is_indexpage)}class="sel"{/if}{if $link.blank} target="_blank"{/if}>{$link.nazev}</a>
  </li>
  {/foreach}
</ul>
