<?php /* Smarty version Smarty-3.1.11, created on 2015-01-11 23:06:37
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/contact/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:305182554aaf4111ddfa6-63897968%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b21f589712363c5b2370a35237e79e0c2bef03ba' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/contact/form.tpl',
      1 => 1421013768,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '305182554aaf4111ddfa6-63897968',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54aaf411272035_18835541',
  'variables' => 
  array (
    'errors' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54aaf411272035_18835541')) {function content_54aaf411272035_18835541($_smarty_tpl) {?><?php if (!is_callable('smarty_function_hana_secured_post')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.hana_secured_post.php';
?>


<form action="?" method="post" id="form-contact">
    <div class="row" data-equalizer>
        <div class="medium-4 columns" data-equalizer-watch>
            <input type="text" name="contactform[jmeno]" class="<?php if (isset($_smarty_tpl->tpl_vars['errors']->value['jmeno'])){?>error<?php }?> radius" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['jmeno'])){?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value['jmeno'];?>
"<?php }?> placeholder="Jméno" required>
            <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['jmeno'])){?><small class="error">Chybné jméno</small><?php }?>
            <input type="email" name="contactform[email]" class="<?php if (isset($_smarty_tpl->tpl_vars['errors']->value['email'])){?>error<?php }?> radius" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['email'])){?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
"<?php }?> placeholder="Email" required>
            <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['email'])){?><small class="error">Chybný email</small><?php }?>
            <input type="tel" name="contactform[telefon]" class="<?php if (isset($_smarty_tpl->tpl_vars['errors']->value['telefon'])){?>error<?php }?> radius" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['telefon'])){?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value['telefon'];?>
"<?php }?> placeholder="Telefon">
            <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['telefon'])){?><small class="error">Chybný telefon</small><?php }?>
        </div>

        <div class="medium-8 columns with-textarea" data-equalizer-watch>
            <textarea rows="6" name="contactform[zprava]" class="<?php if (isset($_smarty_tpl->tpl_vars['errors']->value['zprava'])){?>error<?php }?> radius" required> <?php if (isset($_smarty_tpl->tpl_vars['data']->value['zprava'])){?><?php echo $_smarty_tpl->tpl_vars['data']->value['zprava'];?>
<?php }?></textarea>
            <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['zprava'])){?><small class="error">Chybí zpráva</small><?php }?>
        </div>
    </div>
    <div class="row">
        <div class="small-12 column">
            <input type="hidden" name="contactform[prijmeni]" value=" ">
            <input type="text" name="kontrolni_cislo" value="" class="hide-for-small-up" >
            <button type="submit" name="send" class="button right red tiny radius no-border">ODESLAT DOTAZ</button>
            <?php echo smarty_function_hana_secured_post(array('action'=>"send",'module'=>"contact"),$_smarty_tpl);?>

        </div>
    </div>
</form><?php }} ?>