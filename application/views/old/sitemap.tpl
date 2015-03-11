{* sablona vnitrku mapy-stranek *}
<div id="Sitemap">
  <h2>Stránky v hlavní navigaci</h2>
  <ul>
   {foreach name=nav from=$zarazene key=key item=item}
      <li>
        <a href="{if !$item.indexpage}{$url_base}{$item.nazev_seo}{else}{$url_homepage}{/if}">{$item.nazev}</a>
        {if !empty($item.children)}
          <ul class="jmenu">
          {foreach name=navL2 from=$item.children key=key item=item2}
              <li>{$item2.nazev}</a>
                {if !empty($item2.children)}
                   <ul>
                     {foreach name=l3 from=$item2.children key=key3 item=item3}
                        {if !empty($item3.nazev)}<li><a href="{$url_base}{$item3.nazev_seo}">{$item3.nazev}</a></li>{/if}
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
  <br />
  <h2>Ostatní stránky</h2>
  <ul>
   {foreach name=nav from=$nezarazene key=key item=item}
      <li>
        <a href="{if !$item.indexpage}{$url_base}{$item.nazev_seo}{else}{$url_homepage}{/if}">{$item.nazev}</a>
        {if !empty($item.children)}
          <ul class="jmenu">
          {foreach name=navL2 from=$item.children key=key item=item2}
              <li>{$item2.nazev}</a>
                {if !empty($item2.children)}
                   <ul>
                     {foreach name=l3 from=$item2.children key=key3 item=item3}
                        {if !empty($item3.nazev)}<li><a href="{$url_base}{$item3.nazev_seo}">{$item3.nazev}</a></li>{/if}
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