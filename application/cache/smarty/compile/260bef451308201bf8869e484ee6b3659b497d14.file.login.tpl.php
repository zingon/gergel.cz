<?php /* Smarty version Smarty-3.1.11, created on 2015-01-05 22:38:51
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/modules/hana/views/admin/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:47150987954ab046b3c1c51-22194220%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '260bef451308201bf8869e484ee6b3659b497d14' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/modules/hana/views/admin/login.tpl',
      1 => 1418594757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '47150987954ab046b3c1c51-22194220',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_base' => 0,
    'show_login_error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54ab046b3cd983_78866258',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab046b3cd983_78866258')) {function content_54ab046b3cd983_78866258($_smarty_tpl) {?><div id="LoginForm">
    <div class="panel panel-default">
        <div class="panel-heading">Přihlášení do administrace</div>
        <div class="panel-body">
            <form action="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
admin/login" method="post" class="form-horizontal" role="form">
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

<?php if ($_smarty_tpl->tpl_vars['show_login_error']->value){?>

<script type="text/javascript">
$(function() {
    $("#dialog_2").modal();
});
   
</script>

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
<?php }?><?php }} ?>