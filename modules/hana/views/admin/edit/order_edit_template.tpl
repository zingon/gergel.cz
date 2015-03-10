{* sablona editace objednavky *}	
<br />  	
<form action="#admin_order_form_prod" name="admin_order_form" method="post" id="AdminOrderForm">
  <table width="100%" align="center" border="0" cellspacing="0" cellpadding="2">	  
    <tr>	    
      <td valign="top">	     <h2>Objednávka</h2>	     
        <p>{$order.owner_firma}<br />{$order.owner_ulice}<br />{$order.owner_psc} {$order.owner_mesto}
        </p>	    </td>	    
      <td valign="top" width="10%" align="right">
        {* logo vyrobce <img border="0"  />*}
      </td>	  
    </tr>	
  </table>		
  <table width="100%">	  
    <tr>	    
      <td width="100%" align="center">	    	    </td>	  
    </tr>	
  </table>		
  <table border="0" cellspacing="0" cellpadding="2" width="100%">	  
    <!-- begin customer information -->  	  
    <tr class="sectiontableheader">  	    
      <th align="left" colspan="2">Objednávky
      </th>	  
    </tr>	  
    <tr>  	    <td>Číslo objednávky:</td>	    <td>{$order.order_code}</td>	  
    </tr>	 	  
    <tr>  		<td>Datum objednávky:</td>	    <td>{$order.order_date}</td>	  
    </tr>	  
    <tr>  	    <td>Stav objednávky:</td>	    <td>{$order.order_status}</td>	  
    </tr>	  
    <!-- End Customer Information -->  	  
    <!-- Begin 2 column bill-ship to -->  	  
    <tr class="sectiontableheader">  	    
      <th align="left" colspan="2">Údaje o zákazníkovi
      </th>	  
    </tr>	  
    <tr valign="top">  	    
      <td width="50%"> 
        <!-- Begin BillTo -->	      
        <table width="100%" cellspacing="0" cellpadding="2" border="0">	        
          <tr>  	          
            <td colspan="2"><strong>Fakturovat</strong></td>	        
          </tr>	        		  
          <tr>  			
            <td align="right">Jméno:</td>			<td>{$order.order_shopper_name}</td>		  
          </tr>		  		  		  		  
          <tr>  			
            <td align="right">Ulice:</td>			<td>{$order.order_shopper_street}</td>		  
          </tr>		  		    		  
          <tr>  			
            <td align="right">Město:</td>			<td>{$order.order_shopper_city}</td>		  
          </tr>		  		  
          <tr>  			
            <td align="right">PSČ:</td>			<td>{$order.order_shopper_zip}</td>		  
          </tr>		  		  
          <tr>  			
            <td align="right">Telefon:</td>			<td>{$order.order_shopper_phone}</td>		  
          </tr>
          <tr>  			
            <td align="right">e-mail:</td>			<td>{$order.order_shopper_email}			</td>		  
          </tr>		  		  		  		  	
          {if $order.order_shopper_ic}
          <tr>  			
            <td align="right">IČO:</td>			<td>{$order.order_shopper_ic}</td>		  
          </tr>
          {/if}
          {if $order.order_shopper_dic}		  		  
          <tr>  			
            <td align="right">DIČ:</td>			<td>{$order.order_shopper_dic}</td>		  
          </tr>
          {/if}	  		  
            	      
        </table>	      
        <!-- End BillTo --> </td>	    
      <td width="50%"> 
        <!-- Begin ShipTo -->   	 
        <table width="100%" cellspacing="0" cellpadding="2" border="0">	        
          <tr>  	          
            <td colspan="2"><strong>Dodací adresa</strong>{if $order.no_delivery_address} (stejná jako fakturační){/if}</td>	        
          </tr>	        		  
          <tr>  			
            <td width="35%" align="right">&nbsp;Jméno:</td>			
            <td width="65%">{$order.order_branch_name}</td>		  
          </tr>		  		  
          <tr>  			
            <td width="35%" align="right">&nbsp;Ulice:</td>			
            <td width="65%">{$order.order_branch_street}</td>		  
          </tr>		  		  
          <tr>  			
            <td width="35%" align="right">&nbsp;Město:</td>			
            <td width="65%">{$order.order_branch_city}</td>		  
          </tr>		  		  
          <tr>  			
            <td width="35%" align="right">&nbsp;PSČ:</td>			
            <td width="65%">{$order.order_branch_zip}</td>		  
          </tr>		  		  
          <tr>  			
            <td width="35%" align="right">&nbsp;Telefon:</td>			
            <td width="65%">{$order.order_branch_phone}</td>		  
          </tr>		  		  
          <tr>  			
            <td width="35%" align="right">&nbsp;E-mail:</td>			
            <td width="65%">{$order.order_branch_email}</td>		  
          </tr>		  	      
        </table>	      
        <!-- End ShipTo -->  	      
        <!-- End Customer Information -->  	    </td>	  
    </tr>	  
    <tr>  	    
      <td colspan="2">&nbsp;</td>	  
    </tr>	    	  
    <tr>  	    
      <td colspan="2">  	      
        <table width="100%" border="0" cellspacing="0" cellpadding="1">	         	        
          <tr class="sectiontableheader">  	          
            <th align="left">Údaje pro dopravu
            </th>	        
          </tr>	        
          <tr>
              <td>  
          	   	
                <select name="order_shipping_id">
                  {foreach item=item key=k from=$order_shipping}
                  <option value="{$item.id}" {if $item.id==$order_shipping_sel_id}selected="selected"{/if}>{$item.nazev} - {$item.popis} - {$item.cena}</option>
                  {/foreach}
                </select>
                                                          
              </td>	        
          </tr>	         	      
        </table>	    
      </td>	  
    </tr>  	  
    <tr>	    
      <td colspan="2">&nbsp;</td>	  
    </tr>	
    <tr>  	    
      <td colspan="2">  	      
        <table width="100%" border="0" cellspacing="0" cellpadding="1">	         	        
          <tr class="sectiontableheader">  	          
            <th align="left">Údaje pro platbu
            </th>	        
          </tr>	        
          <tr>  	          
            <td> 
            
             <select name="order_payment_id">
                {foreach item=item key=k from=$order_payment}
                <option value="{$item.id}" {if $item.id==$order_payment_sel_id}selected="selected"{/if}>{$item.nazev} - {$item.cena}</option>
                {/foreach}
              </select>             	          
            </td>	        
          </tr>	         	      
        </table>	    
      </td>	  
    </tr>  	  
    <tr>	    
      <td colspan="2">&nbsp;</td>	  
    </tr>	  
     
    <tr class="sectiontableheader">  	    
      <th align="left" colspan="2">Objednané zboží
      </th>	  
    </tr>	  
    <tr>	    
      <td colspan="4">		    </td>	  
    </tr>	  
     
    <tr>  	    
      <td colspan="2">  
        <a name="admin_order_form_prod" id="admin_order_form_prod"></a>	      
        <table width="100%" cellspacing="0" cellpadding="2" border="0">	        
          <tr align="left">	                    
            <th colspan="2">Kód / Jméno</th>	
            <th>ks/kg</th>                    	          
            <th>Cena (bez DPH)/ks(kg)</th>
            <th>Cena (s DPH)/ks(kg)</th>	          
            <th align="right">Celkem&nbsp;(s DPH)
            </th>	        
          </tr>	
          {* vylistovani starych produktu*}
          {foreach item=item key=k from=$o_products}
                 	        
              <tr align="left">	          
                <td valign="top" colspan="2">
                {if $item.item_zmeneno}* {assign var='zmeneno' value=true}{/if} {$item.item_code} - {$item.item_nazev}
                </td>
                <td valign="top"><input type="text" name="order_product_quantity[{$item.id}]" value="{$item.item_units}" maxlength="5" size="3" /> {$item.item_jednotka}</td>	          
                	          	          
                <td valign="top" align="right">{$item.item_price_bez_dph} Kč</td>	
                <td valign="top" align="right">{$item.item_price_s_dph} Kč</td>	          
                <td valign="top" align="right">{$item.item_cena_s_dph_celkem} Kč&nbsp;&nbsp;&nbsp;</td>	        
              </tr>
                    
          {/foreach}
          
          {* vylistovani novych produktu*}
          {foreach item=item key=k from=$n_products}
                	        
              <tr align="left">	          
                <td valign="top" colspan="2">
                {if $item.item_zmeneno}* {assign var='zmeneno' value=true}{/if}{$item.item_code} - {$item.item_nazev}
                </td>	
                <td valign="top"><input type="text" name="order_product_quantity[{$item.id}]" value="{$item.item_units}" maxlength="5" size="3" /> {$item.item_jednotka}</td>	          
                
                <td valign="top" align="right">{$item.item_price_bez_dph} Kč</td>	          	          
                <td valign="top" align="right">{$item.item_price_s_dph} Kč</td>	          
                <td valign="top" align="right">{$item.item_cena_s_dph_celkem} Kč&nbsp;&nbsp;&nbsp;</td>	        
              </tr>
                   
          {/foreach}
          
          <tr> 

              <tr><td colspan="2">&nbsp;</td><td><input type="submit" value="Přepočítat" class="button btSmall left" /></td><td colspan="3" class="txtRight">* množství položky bylo upraveno</td></tr>
 	          
            <td colspan="5" align="right"><hr /></td>	     
          </tr>	
          
          {* formular pro pridani produktu *}
          <tr align="left">	          
            <td colspan="2">
            <select name="order_product_new" class="new_products">
              {foreach item=item key=k from=$new_products}
                <option value="{$item.id}">{$item.code} - {$item.nazev}</option>
              {/foreach}
            </select>
            </td>
            <td><input type="text" name="order_product_quantity_new" value="0" maxlength="5" size="3" /> Ks(Kg)</td>	          
            
            </td>	          	          
            <td colspan="3" align="right"><input type="submit" name="add_order_item" value="Přidat položku" class="button btSmall left" /></td>	                  
          </tr>
          
           	        
          <tr>  	          
            <td colspan="6" align="right">&nbsp;&nbsp;</td>	        
          </tr>	        
          <tr>  	          
            <td colspan="5" align="right">Mezisoučet (bez DPH):</td>	          
            <td align="right">{$order_total_without_vat} Kč&nbsp;&nbsp;&nbsp;</td>	        
          </tr>
          <tr>  	          
            <td colspan="5" align="right">Mezisoučet (s DPH):</td>	          
            <td align="right">{$order_total_with_vat} Kč&nbsp;&nbsp;&nbsp;</td>	        
          </tr>
          <tr>  	          
            <td colspan="5" align="right">DPH objednaného zboží celkem:</td>	          
            <td align="right">{$order_total_vat} Kč&nbsp;&nbsp;&nbsp;</td>	        
          </tr>	
          <tr>  	          
            <td colspan="4" align="right">&nbsp;</td>	          
            <td colspan="2" align="right">&nbsp;&nbsp;&nbsp;</td>	        
          </tr>	         	        
          <tr>  	          
            <td colspan="5" align="right">Dopravné a balné :</td>	          
            <td align="right">{$order_shipping_price} Kč&nbsp;&nbsp;&nbsp;</td>	        
          </tr>
          <tr>  	          
            <td colspan="5" align="right">Cena za platební metodu :</td>	          
            <td align="right">{$order_payment_price} Kč&nbsp;&nbsp;&nbsp;</td>	        
          </tr>	        
          <tr>  	          
            <td colspan="4" align="right">&nbsp;</td>	          
            <td colspan="2" align="right">
              <hr/></td>	        
          </tr>	        
          <tr>  	          
            <td colspan="5" align="right">	          <strong>Celkem: </strong>	          </td>	           	          
            <td align="right"><strong>{$order_total_CZK} Kč</strong>&nbsp;&nbsp;&nbsp;</td>	        
          </tr>	  	         	        
          <tr>  	          
            <td colspan="4" align="right">&nbsp;</td>	          
            <td colspan="2" align="right">
              <hr/></td>	        
          </tr>	        	    
                
                
        </table>	    </td>	  
    </tr>	 
  </table>	  
  <br />
       
	 		    
  <table width="100%">	      	      
    <tr class="sectiontableheader">	        
      <th align="left" colspan="2">Poznámka zákazníka
      </th>	      
    </tr>	      
    <tr>	        
      <td colspan="2">{$order.order_shopper_note}<br />	       </td>	      
    </tr>	    
  </table>
  <br />
  <input type="hidden" name="old_products" value="{$old_products}" />
  <input type="hidden" name="added_products" value="{$added_products}" />
  
  <input type="submit" value="Uložit změny" name="updateOrder" class="button right" /> &nbsp; 
  
</form>	    