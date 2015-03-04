
<div id="ModalForm1Container">
  <div id="ModalForm1" class="photoeditForm" title="Editace parametru">
    <!--  chybova zprava -->
    {if count($form_errors)>0}
    <div class="ui-widget">
			<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
				<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
				<strong>Chyba:</strong> obrázek nemohl být uložen</p>
			</div>
		</div>
		{/if}

    <div class="left">
      <table>
        <td><label for="nazev">Název</label></td><td><input class="w235" type="text" name="nazev" id="nazev" value="{$nazev}" />{if $form_errors.nazev}<br /><span class="error">{$form_errors.nazev}</span>{/if}</td></tr>
        <td><label for="popis">Popisek</label></td><td><textarea class="w235" name="popis" id="popis">{$popis}</textarea></td></tr>
        <td><label for="zobrazit">Zobrazit</label></td><td><input type="checkbox" name="zobrazit" id="zobrazit"{if $zobrazit} checked="checked"{/if} /></td></tr>
        <td><label for="nazev">Zdroj</label></td><td><input type="file" name="gallery_image_src" id="gallery_image_src" />{if $form_errors.src}<br /><span class="error">{$form_errors.src}</span>{/if}</td></tr>
        <input type="hidden" name="photo_id" value="{$photo_id}" />
        <input type="hidden" name="nahled_src" value="{$nahled_src}" />
        <input type="hidden" name="photoedit_action_add" value="{$entity_name}" />
      </table>
    </div>
    <div class="right photoT">
      {if $nahled_src}<img src="{$nahled_src}" alt="náhled vloženého obrázku" title="{$popis}" />{/if}
    </div>  

  </div>
</div>

{literal}
<script type="text/javascript">
     $(function() {

      // premisteni modalniho formulare mimo hlavni formular - jinak se neodeslou data
      var data=$("#ModalForm1").html();
      $('#JqueryForm form').append(data);

      $("#ModalForm1Container").remove();
      // nasetovani modalniho formulare pridani zavady
      $("#JqueryForm").dialog({
              autoOpen: true,
              bgiframe: true,
              height: 335,
              width: 560,
              modal: true,
              resizable: false,
              open: function(event, ui) {},
              //close: function(event, ui) {\$("#ModalForm1 form .error").html(""); \$("#ModalForm1 .date").datepicker("hide"); \$("#ModalForm1 .date").datepicker("destroy");},
              buttons: {
                      'Uložit': function() {
                               // odeslani formulare
                                 //$(this).dialog('close');
                                  
                                 // odeslani dialogu
                                  $('#JqueryForm form').submit();
                                 
                                 // smazani dat z dialogu
                                 // $("#ModalForm1 form .delAfterSend").val("");
                      },
                      Zrušit: function() {
                              $(this).dialog('close');
                      }
              }
      });

      });
</script>
{/literal}
   