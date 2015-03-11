{* dokument s objednavkou - detail objednavky, nebo obsah mailu *}	

<table class="orderTable">
   <tr>
     <td colspan="2"><h2>Objednávka číslo: &nbsp; <span class="bold">{$order.order_code}</span></h2></td>
   </tr>
   <tr>
     <!-- sloupec s dodavatelem -->
     <td class="dodavatel p20">
       <span class="date">{$order.order_date}</span>&nbsp;| Stav objednávky: <span class="bold">{$order.order_status}</span><br /><br />
       
       <div>dodavatel:</div>
       {*<img src="{$resources_path}img/img_dodavatel_logo.gif" alt="winemarket" title="winemarket" border="0" height="56" width="103" />*}

         <table>
           <tr><td colspan="3" class="title">{$order.owner_firma}</td></tr>
           <tr><td class="col1">{$order.owner_ulice}</td>     <td>IČ:</td><td class="bold">{$order.owner_ic}</td></tr>
           <tr><td>{$order.owner_psc} {$order.owner_mesto}</td>  <td>DIČ:</td><td class="bold">{$order.owner_dic}</td></tr>
           <tr><td colspan="3">&nbsp;</td></tr>
         </table>
         <table>  
           <tr><td>Tel:</td><td class="bold">{$order.owner_tel}</td></tr>
           <tr><td>E-mail:</td><td>{$order.owner_email}</td></tr>
         </table>
         <br />
         <a href="http://{$order.owner_www}" class="bold">{$order.owner_www}</a>
     </td>
     
     <!-- sloupec s odberatelem -->
     <td class="odberatel">
       <div class="box p20">
         <p>odběratel:</p>
         <table>
           <tr><td colspan="3" class="title">{$order.order_shopper_name}</td></tr>
           <tr><td class="col1">{$order.order_shopper_street}</td>     {if $order.order_shopper_ic}<td>IČ:</td><td class="bold">{$order.order_shopper_ic}</td>{else}<td colspan="2"></td>{/if}</tr>
           <tr><td>{$order.order_shopper_zip}, {$order.order_shopper_city}</td>  {if $order.order_shopper_dic}<td>DIČ</td><td class="bold">{$order.order_shopper_dic}</td>{else}<td colspan="2"></td>{/if}</tr>
           <tr><td colspan="3">&nbsp;</td></tr>
         </table>
         <table>  
           <tr><td>Tel:</td><td class="bold">{$order.order_shopper_phone}</td></tr>
           <tr><td>E-mail:</td><td>{$order.order_shopper_email}</td></tr>
         </table>
         <!-- alternativne dodaci adresa -->
         <br />
         <p class="bold">Dodací adresa:</p>
         {if $order.no_delivery_address}
         <p>stejná jako fakturační</p>
         {else}
         <table>
           <tr><td colspan="2">{$order.order_branch_name}</td></tr>
           <tr><td colspan="2">{$order.order_branch_street}</td></tr>
           <tr><td colspan="2">{$order.order_branch_zip}, {$order.order_branch_city}</td></tr>
           <tr><td colspan="2">&nbsp;</td></tr>
            <tr>  			
              <td>Telefon: &nbsp;</td>			
              <td>{$order.order_branch_phone}</td>		  
            </tr>		  		  
            <tr>  			
              <td>E-mail:</td>			
              <td>{$order.order_branch_email}</td>		  
            </tr>	
         </table>
         {/if}

       </div>
       {*
       <!-- volitelny text -->
       <!--
       <p class="p20">
          Tellus dictumst molestie Lorem Sed Cras Pellentesque quis nec egestas et. Quis tempor wisi at facilisi velit sem Nullam Sed Vestibulum ante. Id In pretium eu convallis Integer et at ac augue metus.
       </p>
       -->
       *}
     </td>
     </tr>
     <tr><td colspan="2">&nbsp;</td></tr>
     
     <tr>
       <td colspan="2" class="orderItems">
         <!-- vypis objednaneho zbozi -->
         <table>
            <tr class="grey"><th>Název produktu</th><th class="oiFixCol1">Kód</th><th class="oiFixCol0 txtLeft">Množství</th><th class="oiFixCol2 txtRight">Cena s dph za m.j.</th><th class="priceCol txtRight">Cena s dph</th></tr>  	  	  	 
            
            {foreach item=item key=k name=iter from=$order.products}        	        
            <tr {if $smarty.foreach.iter.iteration mod 2 == 0}class="grey"{/if}>	          
              <td>
              {if $item.zmeneno}* {assign var='zmeneno' value=true}{/if}{$item.nazev}
              </td>	          
              <td>{$item.code}</td>	
              <td class="txtLeft">{$item.units} {$item.jednotka}</td>	                    
              <td class="txtRight">{$item.price_with_tax} Kč</td>	          
              <td class="priceCol">{$item.total_price_with_tax} Kč</td>	        
            </tr>	        
            {/foreach}
            <tr><td colspan="5">&nbsp;</td></tr>
            {if isset($zmeneno)}
            <tr><td colspan="5" class="txtRight">* množství položky bylo upraveno</td></tr>
            {/if}
            
          </table>
        </td>
      </tr>    
      <tr>
        <td colspan="2" class="orderAddition">
           <!-- udaje pro dopravu -->
           <table>
             <tr class="grey"><th>Způsob dopravy</th><th>Upřesnění dopravy</th><th class="priceCol">Cena</th></tr>
             <tr><td>{$order.order_shipping_nazev}</td><td>{$order.order_shipping_descr}</td><td class="oaFixCol priceCol">{$order.order_shipping_price} Kč</td></tr>
           </table>
        </td>
      </tr>
     
      <tr>
        <td colspan="2"  class="orderAddition noborder">
           <!-- udaje pro platbu -->
           <table width="100%">
             <tr class="grey"><th>Způsob platby</th><th class="priceCol">Cena</th></tr>
             <tr><td>{$order.order_payment_nazev}</td><td class="oaFixCol priceCol">{$order.order_payment_price} Kč</td></tr>
           </table>
        </td>
      </tr>  
     
      <tr>
       <td colspan="2" class="orderItems">          
          <table>  
            <tr><td colspan="5">&nbsp;</td></tr>
            <tr><td colspan="4" class="priceLabelCol">Mezisoučet (bez DPH): </td><td class="priceCol">{$order.order_total_without_vat} Kč</td></tr>   
            <tr><td colspan="4" class="priceLabelCol">Mezisoučet (s DPH): 	</td><td class="priceCol">{$order.order_total_with_vat} Kč</td></tr>  
            <tr><td colspan="4" class="priceLabelCol">DPH objednaného zboží celkem: 	</td><td class="priceCol">{$order.order_total_vat} Kč </td></tr>  
            <tr><td colspan="5">&nbsp;</td></tr>
            <tr><td colspan="4" class="priceLabelCol">Dopravné a balné: </td><td class="priceCol">{$order.order_shipping_price} Kč</td></tr>   
            <tr><td colspan="4" class="priceLabelCol">Cena za platební metodu: </td><td class="priceCol">{$order.order_payment_price} Kč</td></tr>   
            <tr><td colspan="5">&nbsp;</td></tr>
            <tr class="grayRow"><td colspan="4" class="priceLabelCol">Celkem:</td><td class="priceCol bold">{$order.order_total_CZK} Kč</td></tr> 
         </table>
       </td>
     </tr>
     
     <tr>
       <td colspan="2" class="orderAddition p20">
         <p>Poznámka zákazníka:</p><br />
         <p>{$order.order_shopper_note}</p>
       </td>
     </tr>  

</table>