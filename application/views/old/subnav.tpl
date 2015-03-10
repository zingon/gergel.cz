{* sablona subnavigace *} 
{if $links|count}
<div id="Subnav"{if !empty($class)}class="{$class}"{/if}>
 <ul>
   {foreach name=nav from=$links key=key item=item}
      {if array_key_exists($key,$sel_links)}{assign var="navTitleClass" value=$item.nav_class}{/if}
      <li class="{if array_key_exists($key,$sel_links)}sel{/if}{if $smarty.foreach.nav.last} last{/if}{if !empty($item.nav_class)} {$item.nav_class}{/if}">
        <a href="{$url_base}{if empty($item.indexpage)}{$item.nazev_seo}{/if}">{$item.nazev}</a>
        {if !empty($item.children) && array_key_exists($key,$sel_links)}
          <ul>
          {foreach name=navL2 from=$item.children key=key2 item=item2}
              <li class="{if array_key_exists($key2,$sel_links)}sel{/if}{if $smarty.foreach.navL2.last} last{/if}"><a href="{$url_base}{$item2.nazev_seo}">{$item2.nazev}</a>
                 {if !empty($item2.children) && array_key_exists($key2,$sel_links)}
                  <ul>
                  {foreach name=navL3 from=$item2.children key=key3 item=item3}
                      <li class="{if array_key_exists($key3,$sel_links)}sel{/if}{if $smarty.foreach.navL3.last} last{/if}"><a href="{$url_base}{$item3.nazev_seo}">{$item3.nazev}</a>
                          {if !empty($item3.children) && array_key_exists($key3,$sel_links)} 
                          <ul>
                            {foreach name=navL4 from=$item3.children key=key4 item=item4}
                                <li class="{if array_key_exists($key4,$sel_links)}sel{/if}{if $smarty.foreach.navL4.last} last{/if}"><a href="{$url_base}{$item4.nazev_seo}">{$item4.nazev}</a></li>
                            {/foreach}
                          </ul>
                          {/if}
                      </li>
                  {/foreach}
                  </ul>
                 {/if}
              
              
              </li>
          {/foreach}
          </ul>
        {/if}
      </li>
   {/foreach}
 </ul>
</div>
{/if}