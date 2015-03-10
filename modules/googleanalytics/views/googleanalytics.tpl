{* sablona pro zapouzdreni GA kodu vcetne Ecommerce Tracking *}

{literal}
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '{/literal}{$ga_account_code}{literal}']);
  _gaq.push(['_setAllowAnchor', true]);
  _gaq.push(['_trackPageview']);
  
  {/literal}
  {* Ecommerce Tracking *}
  {if !empty($ET_data)}
  _gaq.push(['_addTrans','{$ET_data.orderId}',{* order ID - required *}
    '{$ET_data.affiliation}',{* affiliation or store name *}
    '{$ET_data.total}',{* total - required *}
    '{$ET_data.tax}',{* tax *}
    '{$ET_data.shipping}',{* shipping *}
    '{$ET_data.city}',{* city *}
    '{$ET_data.state}',{* state or province *}
    '{$ET_data.country}'{* country *}
  ]);

  {foreach from=$ET_data.order_items key=key item=item}
  _gaq.push(['_addItem','{$item.orderId}',{* order ID - required *}
    '{$item.sku}',{* SKU/code - required *}
    '{$item.name}',{* product name *}
    '{$item.category}',{* category or variation *}
    '{$item.price}',{* unit price - required *}
    '{$item.quantity}'{* quantity - required *}
  ]);
  {/foreach}
  
  _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers
  
  {/if}
  {literal}

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

  
  

</script>
{/literal}





