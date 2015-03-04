<div id="modalDialog">
    <div class="modal fade" id="ModalForm1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Přidání fotografií ze zipu</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {if !empty($form_errors)}
                            <p class="text-danger">Chyba při zpracování zip archivu.</p>
                        {/if}
                        <div class="form-group {if !empty($form_errors.nazev)}has-error{/if}">
                            <label class="control-label col-sm-4" for="nazev">Společný název</label>
                            <div class="col-sm-8">
                                <input type="text" name="nazev" class="form-control input-sm" id="nazev" value="{if !empty($nazev)}{$nazev}{/if}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="popis">Společný popisek</label>
                            <div class="col-sm-8">
                                <textarea name="popis" class="form-control input-sm" id="popis" value="{if !empty($popis)}{$popis}{/if}"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="zobrazit">Zobrazit vše</label>
                            <div class="col-sm-8 text-left">
                                <input type="checkbox" name="zobrazit" id="zobrazit" {if !empty($zobrazit) && $zobrazit} checked="checked"{/if}>
                            </div>
                        </div>
                        {if $language_id==1}
                            <div class="form-group {if !empty($form_errors.src)}has-error{/if}">
                                <label class="control-label col-sm-4" for="zdroj">Zdroj</label>
                                <div class="col-sm-8 text-left">
                                    <input type="file" class="form-control" name="gallery_image_src" id="zdroj">
                                </div>
                            </div>
                        {else}
                            <div class="col-sm-12">
                                <p class="text-info">Novou fotku lze vkládat po přepnutí na základní jazykovou verzi.</p>
                            </div>
                        {/if}
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="seradit">Seřadit soubory</label>
                            <div class="col-sm-8 text-left">
                                <select class="form-control input-sm" name="extract_type" id="seradit">
                                    <option value="name">podle názvu</option>
                                    <option value="time">podle času vytvoření</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p class="text-info">Doporučená velikost archivu do 30 fotek nebo 20MB, přesné hodnoty závisí na nastavení serveru. Velké zip archivy nemusí být řádně zpracovány.</p>
                        </div>
                        <input type="hidden" name="language_id" value="{$language_id}" />
                        <input type="hidden" name="photoedit_action_add_zip" value="{$entity_name}" />
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
   