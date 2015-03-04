{* sablona standardniho administracniho "listu" *}
<div class="row">
  <form action="{$form_url}" method="post">
  <!--  1. sekce hornich ovladacich tlacitek -->
  <div class="col-xs-12">
      <div class="row"> 
        <div class="col-xs-6">
        {if $new_link}
            <a class="btn btn-primary glyphicon-plus" href="{$new_link}" title="Nová položka"> Nová položka</a>
        {/if}
            <a class="btn btn-default glyphicon glyphicon-list-alt" href="?render=csv" title="Exportovat aktuální zobrazení seznamu do formátu CSV (UTF-8)"></a> 
            <a class="btn btn-default glyphicon glyphicon-print" href="?render=print" target="_blank" title="Zformátovat zvolený seznam pro tisk"></a>
        </div>
        {if $filter_button}
            <div class="col-xs-6 text-right">
            {if !$list_table.filtering_row.do_filter}
                <div class="filteringSwitch">
                    <a class="btn btn-default" href="#"> filtrovat seznam</a>
                </div>
            {else}
                <a class="btn btn-default" href="{$form_url}?destroy-filter=true">zrušit filtrování</a>
            {/if}
            </div>
        {/if}
    </div>
  </div>
</div>  

  {* oblast, kde se zobrazi zprava o ulozeni/neulozeni dat - typy: error, default, ok *}
    {if !empty($message)}
<div class="row">
    <div class="col-xs-12 space-5">
        {if $message=="error"} 
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Chyba:</strong> Při zpracování dat došlo k chybě, zkontrolujte prosím zadané údaje.
        </div>
        {elseif $message=="ok"}
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Změny {if $affected_rowid}na položce ID: {$affected_rowid} {/if}byly uloženy.{if $affected_rowid} (<a href="#to_rowid_{$affected_rowid}">přejít na řádek</a>){/if}
        </div>
        {elseif $message=="deleted"}        
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Zvolené položky byly smazány.
        </div>
        {elseif $message=="highlight"}
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Na položce (položkách) {if isset($error_rows)}s ID: <span class="bold">{$error_rows}</span> {/if}byl zadán špatný formát dat, změny zde proto nemohly být uloženy.
        </div>
        {/if}
    </div>
</div>
		{/if}
<div class="row">
    <div class="col-xs-12 space-5" id="table-section">
      <div class="table-responsive">
        <table summary="seznam položek" id="ItemsList" class="table table-default table-hover">
        <thead>
        <!--  2. sekce vypisove tabulky -->
        <!--  nadpisy sloupcu -->
            <tr class="nodrop nodrag">
            {foreach name=iter from=$list_table.head_row key=key item=item}
                <th{if $item.html} {$item.html}{/if}>{$item.content}</th>
            {/foreach}
            {* vypocteni obecnych promennych *}
            {assign var='total_cols' value=$smarty.foreach.iter.total}
            {assign var='total_rows' value=$list_table.data_section|@count}
            </tr>
        </thead>
        <tbody>
        <!--  filtrovaci radek -->
        {if $filter_button}
            <tr class="filteringRow filteringRowHide fr1 nodrop nodrag">
            {foreach name=iter from=$list_table.filtering_row key=key item=item}
                {if !$smarty.foreach.iter.last}
                    <td>{$item}</td>
                {/if}{* posledni polozka v poli je priznak zda bylo filtrovani aktivovano *}
            {/foreach}
            </tr>
            <tr class="filteringRow filteringRowHide fr2 nodrop nodrag">
                <td colspan="{$total_cols}">
                    <div class="right">
                        <button type="submit" class="btn btn-default" name="do-filter" value="filtrovat">filtrovat</button>
                        <button type="submit" class="btn btn-default" name="destroy-filter" value="zrušit filtrování">zrušit filtrování</button>
                    </div>
                </td>
            </tr>
    {/if} 
    
    <!--  telo tabulky -->
      
      {if $total_rows>0}
        {foreach name=iter1 from=$list_table.data_section key=key1 item=row}
        <tr id="rowid_{$key1}"{if $affected_rowid==$key1} class="affected"{/if}>
          {foreach name=iter2 from=$row key=key item=item}
          {* vylistovani dat v jednotlivych radcich - html bunek je stejne se zahlavim *}
          <td{if $list_table.head_row.$key.html} {$list_table.head_row.$key.html}{/if}>{if $smarty.foreach.iter2.first}<a name="to_rowid_{$key1}" id="to_rowid_{$key1}"></a>{/if}{$item}</td>
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
      <tr>
      {foreach name=iter from=$list_table.head_row key=key item=item}
        <td {if $list_table.head_row.$key.html} {$list_table.head_row.$key.html}{/if}>{if isset($list_table.summary_row.$key)}{$list_table.summary_row.$key}{/if}</td>
      {/foreach}
      </tr>  
      {/if}
    </tbody>
    <tfoot>
        <tr class="nodrop nodrag">
            <td colspan="15">                
                {$count_records}
            </td>
        </tr>
    </tfoot>
    </table>
   </div>
  </div>
</div>
<div class="row"> 
    <!--  4. sekce listovani -->
    <div class="col-sm-7">
        {$pagination}
    </div>
    <div class="col-sm-5 text-right strankovani">
        <span class="hidden-xs">Stránkování po:</span>
        <div class="btn-group">
            {foreach from=$items_per_pg key=key item=item}
                <a class="btn btn-default"  {if $key==$items_per_pg_sel}disabled{/if} href="{$form_url}?it_per_pg={$key}" title="Stránkování po {$item} řádcíh" class="ajaxelement">{$item}</a>
            {/foreach}
        </div>
    </div>
</div>

  <!--  5. sekce spodnich ovladacich tlacitek -->
<div class="row">
    <div class="col-xs-12">
         <div class="panel panel-default">
             <div class="panel-body">
                 <div class="row">                    
                    {if $drag_reorder}
                    <div class="col-sm-6 hidden-xs">
                        <img src="{$media_path}admin/img/arrow_up_down.png" alt="Řazení tažením myší je aktivní" width="16" height="16" />
                            Řazení položek tažením myší je <strong>aktivováno</strong>.
                    </div>
                    {/if}
                    
                    <div class="col-sm-{if $drag_reorder}6{else}12{/if} text-right">
                             <label for="sellAll"> vybrat vše</label> 
                             <input type="checkbox" name="sellAll" type="form-control" class="sellAll" id="sellAll" />
                        {if $delete_button}
                        <button type="submit" class="btn btn-warning" name="hana_form_action[delete]" value="smazat označené"  onclick="javascript: return confirm('Opravdu smazat vybrané položky?'); ">smazat označené</button>{/if}
                        {if $save_button}
                        <button type="submit" class="btn btn-primary" name="hana_form_action[save]" value="{$save_button}"  onclick="javascript: return confirm('Opravdu uložit provedené změny?'); ">{$save_button}</button>{/if}
                        {if !empty($default_buttons)}
                        {foreach name=db from=$default_buttons item=item}
                            <button type="{$item.type}" class="btn btn-default" id="button_{$item.action}" name="hana_form_action[{$item.action}]" value="{$item.nazev}" {if $item.onclick}onclick="javascript: return confirm('{$item.onclick}');" {/if}>{$item.nazev}</button>
                        {/foreach}
                        {/if}
  
                    </div>    
                    </form>
                 </div>
             </div>
         </div>
    </div>
</div>

{literal}
<script type="text/javascript">
$(document).ready(function(){
  {/literal}{if $list_table.filtering_row.do_filter}{literal}
  $(".filteringRow").removeClass("filteringRowHide");
  {/literal}{/if}
   {literal}
 
  {/literal}{if $drag_reorder}{literal}
  $("#table-section table").tableDnD({
    onDrop: function(table, row) {
      
                   xurl = $(this).attr("href"); 
                   $('#ContentSection tbody').showLoading(); 
                   $(this).attr("href","javascript: //ajax_request_process;"); 
                   $.ajax({
                     type: "GET",
                     url: "?hana_form_action=drag_change_order&reorder_item="+row.id+"&" + $.tableDnD.serialize(),
                     success: function(msg){
                     //alert( "Obdržená data: " + msg );
                     $('#ContentSection tbody').hideLoading(); 
                     $('#ContentSection').html(msg);
                     //$(this).attr("href",xurl);
                     },
                     error: function(XMLHttpRequest, textStatus, errorThrown){
                        $('#ContentSection tbody').hideLoading(); 
                        alert("Při zpracování dat došlo k chybě");
                        //alert("Při zpracování dat došlo k chybě: " + XMLHttpRequest + ", textStatus: " + textStatus+ ", errorThrown: " + errorThrown);
                     }
                 
      });
    }
   
  });
  {/literal}{/if}{literal}
  
});     
</script>
{/literal}

