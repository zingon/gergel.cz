<div id="LoginForm">
    <div class="panel panel-default">
        <div class="panel-heading">Přihlášení do administrace</div>
        <div class="panel-body">
            <form action="{$url_base}admin/login" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">username:</label>
                    <div class="col-sm-9">
                        <input type="text" name="username" class="form-control" id="username" placeholder="username" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">password:</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="password" placeholder="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" value="přihlásit" class="btn btn-primary">Sign in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{if $show_login_error}
{literal}
<script type="text/javascript">
$(function() {
    $("#dialog_2").modal();
});
   
</script>
{/literal}
<div class="modal fade" tabindex="-1" role="dialog" id="dialog_2">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title text-danger">Přihlášení se nezdařilo</h4>
        </div>
        <div class="modal-body">
            Zadali jste chybné jméno, nebo heslo.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
{/if}