<script src="{$media_path}admin/js/jquery.flash.min.js" type="text/javascript"></script>
<script src="{$media_path}admin/js/agile-uploader-3.0.js" type="text/javascript"></script>

<div id="modalDialog">
    <div class="modal fade" id="ModalForm2" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hromadné přidání fotografií</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="photoedit_action_add_multiple" value="{$entity_name}" />
                        <div id="Multiple"></div>
                        <div class="correct mediumMT">Maximální počet současně vkládaných obrázků: {$max_files}.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="upload_photo">Nahrát</button>
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

        $('#ModalForm2').modal();

        $('#ModalForm2').on('shown.bs.modal', function(e){

        });

        $("button#upload_photo").click(function(e){
            document.getElementById('agileUploaderSWF').submit();
            e.preventDefault();
        });

        $('#Multiple').agileUploader({
            submitRedirect: '{/literal}{$base_admin_path}?message=highlight{literal}',
            formId: 'JqueryFormIN',
            flashVars: {
                firebug: false,
                form_action: '{/literal}{$base_admin_path}{literal}',
                max_width: 1920,
                max_height: 1080,
                jpg_quality: 90,
                file_limit: {/literal}{$max_files}{literal},
                max_post_size: (10000 * 1024),
            }
        });








    });
</script>
{/literal}
