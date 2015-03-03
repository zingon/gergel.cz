{* sablona standardniho administracniho "editu" *}

<div id="EditTableSection">
  <form action="{$form_url}" method="post" enctype="multipart/form-data" name="EditForm" id="EditForm">
    {*<a class="toolButts" href="http://localhost/expoweb/admin_menu/itemList/1"><img src="http://localhost/expoweb/application/views/admin/img/page_go.png" alt="Zpět" title="Zpět" /> <span>Zpět na seznam</span></a><a class="toolButts" href="http://localhost/expoweb/admin_menu/itemEdit/8/1/1"><img src="http://localhost/expoweb/application/views/admin/img/page_copy.png" alt="klonovat položku" title="klonovat položku" /> <span>Klonovat záznam</span></a><a name="top" id="top"></a><div id="AdminTableTop" style="width: 801px"><div class="in"></div></div>*}
    
    <a class="toolButts" href="{$back_link}"><img src="{$media_path}admin/img/page_go.png" alt="Zpět" title="Zpět" /><span>{$back_link_text}</span></a>
    
    {if $languages}
    <div class="right languageButts">
    
      <ul>
        {if $admlang!="cz"}<li><a href="?copylang=true">kopírovat z cz</a></li>{/if}
        <li{if $admlang=="en"} class="sel"{/if}><a href="?admlang=en">en</a></li>
        <li{if $admlang=="sk"} class="sel"{/if}><a href="?admlang=sk">sk</a></li>
        <li{if $admlang=="cz"} class="sel"{/if}><a href="?admlang=cz">cz</a></li>
      </ul>
    
    </div>
    {/if}
    
    {* oblast, kde se zobrazi zprava o ulozeni/neulozeni dat - typy: error, default, ok *}
    {if $message}
    <div class="ui-widget correct">
			<div class="ui-state-{$message} ui-corner-all"> 
				<p>
        {if $message=="error"} 
        <span class="ui-icon ui-icon-alert"></span>
				<strong>Chyba:</strong> Při zpracování dat došlo k chybě, zkontrolujte prosím zadané údaje.
        {elseif $message=="ok"}
        <span class="ui-icon ui-icon-check"></span>
        Položka byla úspěšně uložena.
        {elseif $message=="highlight"}
        <span class="ui-icon ui-icon-info"></span>
        Změna byla provedena.
        {/if}
        </p>
			</div>
		</div>
		{/if}

    
    <div class="tableTop"><div class="in"></div></div>
    {if $script}
    <script type="text/javascript">
    {$script}
    </script>
    {/if}
    <table summary="editační formulář">
      {*<tr><th colspan="2" class="center">editační formulář</th></tr>*}
      {if count($action_buttons)>0}
      <tr>
          <td class="buttonsBar" colspan="2">
              {foreach name=a_butts from=$action_buttons key=key item=item}
              <input type="submit" id="{$item.name}" name="{$item.name}" value="{$item.value}" class="button" />
              {/foreach}
          </td>
      </tr>
      {/if}
      <tr><td colspan="2">&nbsp;</td></tr>
      
      {foreach name=data_section from=$edit_table.data_section key=key item=item} 
        <tr{if $row_parameters.$key.class} class="{$row_parameters.$key.class}"{/if}>
          {if $row_parameters.$key.variant != "one_col"}<td class="col1">{if $row_parameters.$key.label}<label for="item_{$key}">{$row_parameters.$key.label}</label>{else}&nbsp;{/if}</td> {/if}
          <td class="col2" id="item_{$key}" {if $row_parameters.$key.variant == "one_col"}colspan="2"{/if}>{$item} {if !$row_errors.$key}{$row_parameters.$key.condition}{else}<span class="text_error">{$row_errors.$key}</span>{/if}</td>
        </tr>
      {/foreach}

      <tr><td colspan="2">&nbsp;</td></tr>
      {if count($action_buttons)>0}
      <tr>
          <td class="buttonsBar" colspan="2">
              {foreach name=a_butts from=$action_buttons key=key item=item}
              <input type="submit" id="{$item.name}" name="{$item.name}" value="{$item.value}" class="button" />
              {/foreach}
          </td>
      </tr>
      {/if}
    </table>
    <div id="AdminTableBottom" style="width: 801px"><div class="in"></div></div>
    <input type="hidden" id="hana_edit_action" name="hana_form_action" value="main" /> {* ststicky definovana akce "main" na odeslani formulare *}
              
  </form>
  <div id="JqueryForm" title="editace položky"><form action="{$form_url}" method="post" enctype="multipart/form-data">{* sem vklada jquery dynamicky vytvorene formulate - vnorene v hlavnim formulari nefunguji*}</form></div>
  <div class="tableBottom"><div class="in"></div></div>
</div>


