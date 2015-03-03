<?php /* Smarty version Smarty-3.1.11, created on 2014-12-13 20:51:35
         compiled from "E:\Work\webs\orbcomm\application\views\contactform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15251548c98c74fb940-12164147%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3508af295fcd3703307d4adc17f8fa28cb5f8aa1' => 
    array (
      0 => 'E:\\Work\\webs\\orbcomm\\application\\views\\contactform.tpl',
      1 => 1417799188,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15251548c98c74fb940-12164147',
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
  'unifunc' => 'content_548c98c7687db0_79715386',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548c98c7687db0_79715386')) {function content_548c98c7687db0_79715386($_smarty_tpl) {?><?php if (!is_callable('smarty_function_hana_secured_post')) include 'E:\\Work\\webs\\orbcomm\\modules\\smarty\\plugins\\function.hana_secured_post.php';
?>


<form action="?" method="post">
    <div class="row">
        <div class="large-6 medium-12 small-6 columns">
            <input type="text" name="contactform[jmeno]" <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['jmeno'])){?>class="error"<?php }?> <?php if (isset($_smarty_tpl->tpl_vars['data']->value['jmeno'])){?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value['jmeno'];?>
"<?php }?> placeholder="Jméno" required>
            <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['jmeno'])){?><small class="error">Chybné jméno</small><?php }?>
        </div>
        <div class="large-6 medium-12 small-6 columns">
            <input type="email" name="contactform[email]" <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['email'])){?>class="error"<?php }?> <?php if (isset($_smarty_tpl->tpl_vars['data']->value['email'])){?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
"<?php }?> placeholder="Email" required>
            <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['email'])){?><small class="error">Chybný email</small><?php }?>
        </div>
    </div>
    <textarea rows="6" name="contactform[zprava]" <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['zprava'])){?>class="error"<?php }?> required> <?php if (isset($_smarty_tpl->tpl_vars['data']->value['zprava'])){?><?php echo $_smarty_tpl->tpl_vars['data']->value['zprava'];?>
<?php }?></textarea>
    <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['zprava'])){?><small class="error">Chybí zpráva</small><?php }?>

  <?php echo smarty_function_hana_secured_post(array('action'=>"send",'module'=>"contact"),$_smarty_tpl);?>

  <input type="text" name="kontrolni_cislo" value="" class="hidden-for-small-up" >
  <button type="submit" name="send" class="button right tiny">ODESLAT DOTAZ</button>
</form>
<br /><br />
<?php }} ?>