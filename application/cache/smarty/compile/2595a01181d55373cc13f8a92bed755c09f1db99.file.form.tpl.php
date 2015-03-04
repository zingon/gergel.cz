<?php /* Smarty version Smarty-3.1.11, created on 2015-02-13 16:46:37
         compiled from "/var/www/orbcomm.cz/domains/www/application/views/contact/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:154280728254de1c5d869123-63264711%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2595a01181d55373cc13f8a92bed755c09f1db99' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/application/views/contact/form.tpl',
      1 => 1423822081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '154280728254de1c5d869123-63264711',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54de1c5d8d76f1_13280697',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54de1c5d8d76f1_13280697')) {function content_54de1c5d8d76f1_13280697($_smarty_tpl) {?><?php if (!is_callable('smarty_function_hana_secured_post')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.hana_secured_post.php';
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