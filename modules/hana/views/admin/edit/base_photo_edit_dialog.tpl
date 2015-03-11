<div id="modalDialog">
<div class="modal fade" id="ModalForm1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editace položky</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {if count($form_errors)>0}
                        <p class="text-danger">Chyba: obrázek nemohl být uložen.</p>
		            {/if}
                    <div class="form-group {if !empty($form_errors.nazev)}has-error{/if}">
                        <label class="control-label col-sm-2" for="nazev">Název</label>
                        <div class="col-sm-10">
                            <input type="text" name="nazev" class="form-control input-sm" id="nazev" value="{if !empty($nazev)}{$nazev}{/if}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="popis">Popisek</label>
                        <div class="col-sm-10">
                            <textarea name="popis" class="form-control input-sm" id="popis" value="{if !empty($popis)}{$popis}{/if}"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="zobrazit">Zobrazit</label>
                        <div class="col-sm-10 text-left">
                            <input type="checkbox" name="zobrazit" id="zobrazit" {if !empty($zobrazit) && $zobrazit} checked="checked"{/if}>
                        </div>
                    </div>
                    {if $language_id==1}
                        <div class="form-group {if !empty($form_errors.src)}has-error{/if}">
                            <label class="control-label col-sm-2" for="zdroj">Zdroj</label>
                            <div class="col-sm-10 text-left">
                                <input type="file" class="form-control" name="gallery_image_src" id="zdroj" value="{if !empty($popis)}{$popis}{/if}">
                            </div>
                        </div>
                    {else}
                        <div class="form-group">
                            <p class="text-info col-sm-12">Novou fotku lze vkládat po přepnutí na základní jazykovou verzi.</p>
                        </div>
                    {/if}
                    <div class="form-group">
                        <div class="col-xs-12">
                        {if !empty($nahled_src)}                            
                            <img src="{$nahled_src}" alt="náhled vloženého obrázku" class="img-responsive" title="{$popis}" />
                        {/if}
                        </div>
                    </div>
                    <input type="hidden" name="photo_id" value="{$photo_id}" />
                    <input type="hidden" name="language_id" value="{$language_id}" />
                    <input type="hidden" name="nahled_src" value="{$nahled_src}" />
                    <input type="hidden" name="photoedit_action_add" value="{$entity_name}" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Uložit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>                
            </div>
        </div>
    </div>
</div>
</div>


{literal}
<script type="text/javascript">
     $(function() {
      // premisteni modalniho formulare mimo hlavni formular - jinak se neodeslou data
      var data=$("#modalDialog").html();
      $("#modalDialog").remove();
      $('#JqueryFormIN').append(data);      
      
      $('#ModalForm1').modal();
    
      $('#ModalForm1').on('shown.bs.modal', function(e){
        
      });



      });
</script>
{/literal}
   