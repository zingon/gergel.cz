{* sablona navigace *}
<ul>
 {* prvni sloupec budou odkazy bez pododkazu*}
 <li>
   <ul class="empty_links">
   {foreach name=stix from=$empty_links key=key item=item}
      <li>
        <a href="{$url_base}{if !$item.indexpage}{$item.nazev_seo}{/if}">{$item.nazev}</a>
      </li>
   {/foreach}
   </ul>
 </li>

 {foreach name=stix from=$links key=key item=item}
    <li class="it{$item.id}{if $smarty.foreach.stix.last} last{/if}">
      <a href="{$url_base}{if !$item.indexpage}{$item.nazev_seo}{/if}">{$item.nazev}</a>
      {if !empty($item.children)}
        <ul>
        {foreach name=navL2 from=$item.children key=key item=item2}
            <li><a href="{$url_base}{$item2.nazev_seo}">{$item2.nazev}</a></li>
        {/foreach}
        </ul>
      {/if}
    </li>
 {/foreach}
</ul>

