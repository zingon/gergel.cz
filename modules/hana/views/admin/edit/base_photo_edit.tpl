{* sablona standardniho administracniho "editu" *}

{literal}
<script type="text/javascript">
          $(function(){
            var quicksort_item;
            $('#PhotoPreviewBox .item').mousedown(function(){quicksort_item=$(this);});
            $('#PhotoPreviewBox').sortable({
                opacity: 0.8,
                cursor: 'move'
                });

             $('#PhotoPreviewBox').bind('sortupdate', function(event, ui) {
             quicksort_item.addClass('sortUpdate');
             $('#PhotoPreviewBox').sortable('disable');
             xdata=($('#PhotoPreviewBox').sortable('serialize'));

             $.ajax({
                         type: "GET",
                         url: "?photoedit_action_reorder_drag={/literal}{$entity_name}{literal}&item[]="+quicksort_item.attr('id')+"&"+xdata,
                         success: function(msg){
                         //alert("Obdržená data: " + msg);
                         $('#ContentSection').html(msg);
                         },
                         error: function(XMLHttpRequest, textStatus, errorThrown){
                         //$("#LogoAjax").attr("src","".$this->resource_path."/admin/img/server_delete.png");
                         //alert("Chyba zpracování požadavku. XMLHttpRequest: " + XMLHttpRequest + ", textStatus: " + textStatus+ ", errorThrown: " + errorThrown);
                         }
                     });

            });
            
            
            
          });
</script>
{/literal}

<div id="PhotoPreviewBox">
{foreach name=pht from=$photos key=key item=item}
  <div class="item" id="item_{$item.id}">
    <a name="{$item.id}" class="scrolItem"></a>
    <a href="{$item.src_ad}" class="lightbox-enabled" rel="lightbox-myGroup" title="{$item.nazev}">
      <img src="{$item.src_at}" alt="náhled vloženého obrázku" title="{$item.nazev}" />
    </a>
    <div class="footer">
      <div class="title">{if !$item.nazev && !$item.language_id}-- nenaplněno pro jaz. verzi --{else}{$item.nazev}{/if}</div>
      <div class="tools">
        
        {if $item.move_up}
        <a href="{$admin_path}?photoedit_action_reorder={$entity_name}&amp;photo_id={$item.id}&amp;reorder_direction=up" class="ajaxelement img92">
          <img src="{$media_path}admin/img/left.gif" class="left" alt="vyměnit s předchozím" title="vyměnit s předchozím" />
        </a>
        {else}
          <img src="{$media_path}admin/img/none.gif" class="left" alt="první položka" />
        {/if}
        
        <a class="ajaxelement" href="{$admin_path}?photoedit_action_visibility={$entity_name}&amp;photo_id={$item.id}&amp;state_value={if $item.zobrazit}0{else}1{/if}">
          <img src="{$media_path}admin/img/{if $item.zobrazit}lightbulb{else}lightbulb_off{/if}.png" alt="zobrazit / skrýt" title="zobrazit / skrýt" />
        </a>
        
        <a class="ajaxelement" href="{$admin_path}?main_gallery_editphoto={$item.id}">
          <img src="{$media_path}admin/img/image_edit.png" alt="editovat" title="editovat" />
        </a>
        
        <a href="{$admin_path}?photoedit_action_delete={$entity_name}&amp;photo_id={$item.id}" class="ajaxelement confirmDelete">
          <img src="{$media_path}admin/img/delete.png" alt="smazat" title="smazat" />
        </a>
        
        <input type="checkbox" name="selitem[{$item.id}]" />
        
        
        {if $item.move_down}
        <a href="{$admin_path}?photoedit_action_reorder={$entity_name}&amp;photo_id={$item.id}&amp;reorder_direction=down" class="ajaxelement img92">
          <img src="{$media_path}admin/img/right.gif" class="right" alt="vyměnit s následujícím" title="vyměnit s následujícím" />
        </a>
        {else}
          <img src="{$media_path}admin/img/none.gif" class="right" alt="poslední položka" />
        {/if}
        
      </div>
    </div>
  </div>
{/foreach}  <div class="clear"></div> 
</div>

  {if !empty($photos)}
<div class="row">    
    <div class="col-md-12 text-right" id="photo-delete">
        <div class="panel panel-default">
            <div class="panel-body">
                <input type="hidden" name="delitem_gallery" value="{$entity_name}">        
                vybrat vše <input type="checkbox" name="sellAll" class="sellAll" id="sellAll" />
                <button type="submit" class="btn btn-warning" name="delitem" value="smazat označené" onclick="javascript: return confirm('Opravdu smazat vybrané položky?'); ">smazat označené</button>       
            </div>
        </div>
    </div>
</div>
  {/if}
  