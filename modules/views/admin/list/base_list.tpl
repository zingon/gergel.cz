{* sablona standardniho administracniho "listu" *}

<div id="ListTableSection">
  <form action="{$form_url}" method="post">
  <!--  1. sekce hornich ovladacich tlacitek -->
  
  {if $new_link}
    <a class="toolButts" style="margin-right: 150px;" href="{$new_link}" title="Nová položka"><img src="{$media_path}admin/img/add.png" alt="přidat novou položku" title="přidat novou položku" /> <span>Nová položka</span></a>
  {/if}
  
  {if $filter_button}
    {if !$list_table.filtering_row.do_filter}
    <span class="filtering filteringSwitch">
      <a class="filt" href="#"><img src="{$media_path}admin/img/filter.png" alt="filtrovat obsah" title="filtrovat obsah" /></a> &nbsp;<a class="filt filteringA" href="#">filtrovat obsah</a> <a href="#" class="filt filteringB"><img src="{$media_path}admin/img/rozbalit.gif" alt="filtrovat obsah" title="filtrovat obsah" /></a>
    </span>
    {else}
    <span class="filtering">
      <a class="filt" href="{$form_url}?destroy-filter=true"><img src="{$media_path}admin/img/filter.png" alt="filtrovat obsah" title="filtrovat obsah" /></a> &nbsp;<a class="filt filteringA" href="{$form_url}?destroy-filter=true">zrušit filtrování</a> <a href="{$form_url}?destroy-filter=true" class="filt filteringB"><img src="{$media_path}admin/img/sbalit.gif" alt="zrušit filtrování" title="zrušit filtrování" /></a>
    </span>
    {/if}
  {/if}
  
  {* oblast, kde se zobrazi zprava o ulozeni/neulozeni dat - typy: error, default, ok *}
    {if $message}
    <div class="ui-widget correct">
			<div class="ui-state-{if $message=="deleted"}highlight{else}{$message}{/if} ui-corner-all"> 
				<p>
        {if $message=="error"} 
        <span class="ui-icon ui-icon-alert"></span>
				<strong>Chyba:</strong> Při zpracování dat došlo k chybě, zkontrolujte prosím zadané údaje.
        {elseif $message=="ok"}
        <span class="ui-icon ui-icon-check"></span>
        Změny byly uloženy.
        {elseif $message=="deleted"}
        <span class="ui-icon ui-icon-info"></span>
        Zvolené položky byly smazány.
        {elseif $message=="highlight"}
        <span class="ui-icon ui-icon-info"></span>
        Na položce (položkách) s ID: <span class="bold">{$error_rows}</span> byl zadán špatný formát dat, změny zde proto nemohly být uloženy. 
        {/if}
        </p>
			</div>
		</div>
		{/if}
  
  <div class="tableTop"><div class="in"></div></div>
    <table summary="seznam položek">
    <thead>
    <!--  2. sekce vypisove tabulky -->
     
    <!--  nadpisy sloupcu -->
    <tr>
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
          <td{if $list_table.head_row.$key.html} {$list_table.head_row.$key.html}{/if}>{$item}</td>
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
    </tbody>
    </table>
    
  <!--  3. sekce listovani -->
  
  <div id="ListTablePagination">
    <div class="left">{$count_records}&nbsp;&nbsp;|&nbsp;&nbsp;{$pagination}
    </div>
    <div class="right">Stránkování po: 
      {foreach from=$items_per_pg key=key item=item}
         {if $item==$items_per_pg_sel}
         <span class="sel"> {$item} </span>
         {else}
         <a href="{$form_url}?it_per_pg={$item}" title="Stránkování po {$item} řádcíh" class="ajaxelement">{$item}</a>
         {/if}  
      {/foreach}
      <div class="correct">
      </div>
    </div>
    <div class="correct">
    </div>
  </div>
  
  <!--  4. sekce spodnich ovladacich tlacitek -->
  
  <div id="ListTableFormControls">
    <input type="checkbox" name="sellAll" class="sellAll" /> vybrat vše &nbsp;&nbsp;
    {if $delete_button}<input type="submit" class="subm button" name="hana_form_action[delete]" value="smazat označené"  onclick="javascript: return confirm('Opravdu smazat vybrané položky?'); " />{/if}
    {if $save_button}<input type="submit" class="subm button" name="hana_form_action[save]" value="{$save_button}"  onclick="javascript: return confirm('Opravdu uložit provedené změny?'); " />{/if}
    
  </div>

  </form>
  <div class="tableBottom"><div class="in"></div></div>
</div>

{if !$list_table.filtering_row.do_filter}
  {literal}
  <script type="text/javascript">
       $(".filteringRow").addClass("filteringRowHide");
       
  </script>
  {/literal}
{/if}