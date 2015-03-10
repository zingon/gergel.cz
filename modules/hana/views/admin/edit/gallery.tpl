{* sablona standardniho administracniho "editu" *}

<div class="row">  
    <form action="{$form_url}" method="post" enctype="multipart/form-data" name="EditForm" id="EditForm">
    <div class="col-md-{if empty($edtiable_languages)}12{else}4{/if}">
      {if isset($back_to_item) && $back_to_item}
        <a class="btn btn-default" href="{$back_to_item}">
            <span class="glyphicon-chevron-left glyphicon"></span>
            <span>{$back_to_item_text}</span>       
        </a>
      {/if}      
      <a class="btn btn-default" href="{$back_link}">
          <span class="glyphicon-chevron-left glyphicon"></span>
          <span>{$back_link_text}</span>          
      </a>
      {if $clone_link}
        <a class="btn btn-default" href="{$clone_link}">
            <img src="{$media_path}admin/img/page_copy.png" alt="Otevře formulář pro vložení nové položky s předvyplněnými základními daty" />
            <span>{$clone_link_text}</span></a>
      {/if}
      
    </div>   

    {if !empty($edtiable_languages)}        
    <div class="col-md-8 text-right">
        {foreach from=$edtiable_languages key=k item=item}
            <a class="{if $k==$sel_language_id}active{elseif $disable_other_languages}disabled{/if} btn btn-default" {if $disable_other_languages && $k!=$sel_language_id}href="#" title="Uložte formulář nejprve v základní jazykové verzi"{else}href="?admlang={$k}" title="jazyková verze: {$item}"{/if}>{$item}</a>
        {/foreach}
        {if $sel_language_id!=1 && $copy_lang_link}
          <a href="?copylang=true" class="btn btn-info">kopírovat z {$main_language}</a></li>
        {/if}      
    </div>
    {/if}
</div>
     
    {* oblast, kde se zobrazi zprava o ulozeni/neulozeni dat - typy: error, default, ok *}
    {if !empty($message)}  
<div class="row">
    <div class="col-md-12 space-5">
        {if $message=="error"} 
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Chyba:</strong> Při zpracování dat došlo k chybě, zkontrolujte prosím zadané údaje.
        </div>
        {elseif $message=="ok"}
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Změny byly uloženy.
        </div>
        {elseif $message=="deleted"}        
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Zvolené položky byly smazány.
        </div>
        {elseif $message=="highlight"}
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Změna byla provedena.
        </div>
        {/if}
    </div>
</div>
		{/if}

     
    {if $script}
    <script type="text/javascript">
    {$script}
    </script>
    {/if}
{if isset($edit_table.data_section.link_new) && array_key_exists("link_new", $edit_table.data_section)}
<div class="row">
    <div class="col-md-12 margin-top-10 margin-bottom-10">
        {$edit_table.data_section.link_new}
    </div>
</div>
{/if}
<div class="row">
    <div class="col-md-12 margin-top-10">
      {foreach name=data_section from=$edit_table.data_section key=key item=item} 
        {if $key == "link_new"}{continue}{/if}
          
            {$item}
            {if empty($row_errors.$key)}
                {if !empty($row_parameters.$key.condition)}
                    <p class="text-info">{$row_parameters.$key.condition}</p>
                {/if}
              {else}
              <p class="text-danger">{$row_errors.$key}</span>
              {/if}
      {/foreach}

    <input type="hidden" id="hana_edit_action" name="hana_form_action" value="main" /> {* ststicky definovana akce "main" na odeslani formulare *}
              
    </form>
        <form id="JqueryFormIN" role="form" action="{$form_url}" method="post" enctype="multipart/form-data">{* sem vklada jquery dynamicky vytvorene formulate - vnorene v hlavnim formulari nefunguji*}</form>
    </div>
</div>


