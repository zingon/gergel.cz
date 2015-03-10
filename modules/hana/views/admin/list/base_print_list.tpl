{* tiskova sablona standardniho administracniho "listu" *}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">	
  <head>		
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />		
    <meta http-equiv="content-language" content="cs" />		
    <meta name="author" content="" />		
    <meta name="copyright" content="" />		
    <meta name="description" content="" />		
    <meta name="keywords" content="" />	
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
    	
    <link rel="stylesheet" href="{$media_path}admin/css/style-print-list.css" type="text/css" media="screen, print" />
    <script type="text/javascript" src="{$media_path}admin/js/jquery-1.7.1.min.js"></script>
    
    <title>Tisková stránka</title>	
      
  </head>
  <body>
  {literal}
  <script type="text/javascript">
  $(document).ready(function() { 
    window.print();
  });
  {/literal}  
  </script>
  <div id="ListTableSection">
  <h1 class="left">{$submodule_title}{if $submodule_description} - {$submodule_description}{/if}</h1>
  <div class="projName">WWW stránky: <span class="bold">{$owner.default_title}</a></div>
    <table summary="seznam položek">
      <thead>
      <!--  2. sekce vypisove tabulky -->
       
      <!--  nadpisy sloupcu -->
      <tr>
      {foreach name=iter from=$list_table.head_row key=key item=item}
        <th{if !empty($item.html)} {$item.html}{/if}>{$item.content}</th>
      {/foreach}
      
      {* vypocteni obecnych promennych *}
      {assign var='total_cols' value=$smarty.foreach.iter.total}
      {assign var='total_rows' value=$list_table.data_section|@count}
    
      </tr>
      </thead>
      <tbody>
      <!--  filtrovaci radek -->
      {if $filter_button}
    
        <tr class="filteringRow fr1 nodrop">
          {foreach name=iter from=$list_table.filtering_row key=key item=item}
            {if !$smarty.foreach.iter.last}<td>{$item}</td>{/if}{* posledni polozka v poli je priznak zda bylo filtrovani aktivovano *}
          {/foreach}
        </tr>
        <tr class="filteringRow fr2 nodrop">
          <td colspan="{$total_cols}">
            <div class="right">
              <input type="submit" class="subm button" name="do-filter" value="filtrovat" />
              <input type="submit" class="subm button" name="destroy-filter" value="zrušit filtrování" />
            </div>
          </td>
        </tr>
      {/if} 
      
      <!--  telo tabulky -->
        
        {if $total_rows>0}
          {foreach name=iter1 from=$list_table.data_section key=key item=row}
          <tr>
            {foreach name=iter2 from=$row key=key item=item}
            {* vylistovani dat v jednotlivych radcich - html bunek je stejne se zahlavim *}
            <td{if !empty($list_table.head_row.$key.html)} {$list_table.head_row.$key.html}{/if}>{$item}</td>
            {/foreach}
          </tr>
          {/foreach}
         {else}
            <tr><td colspan="{$total_cols}"><div class="txtCenter">
            {if !$list_table.filtering_row.do_filter}
            -- bez záznamu --
            {else}
            -- pro zvolené nastavení filtru nebyl nalezen žádný záznam --
            {/if}
            </div></td></tr>
         {/if}
         
         <!--  3. sekce - sumarizacni radek - nepovinne --> 
          {if !empty($list_table.summary_row)}
          <tr class="summaryRow">
          {foreach name=iter from=$list_table.head_row key=key item=item}
            <td>{if isset($list_table.summary_row.$key)}{$list_table.summary_row.$key}{/if}</td>
          {/foreach}
          </tr>  
          {/if}
       
      </tbody>
    </table>
    <div class="footer">
       <div class="right">Výtisk ze systému pro správu obsahu Hana 2 &copy; 2011</div>
    </div>
    </div>
  </body>
</html>  
 