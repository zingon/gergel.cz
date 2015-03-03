<?php /* Smarty version Smarty-3.1.11, created on 2015-01-05 21:28:44
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/breadcrumbs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142783672854a0ae457c9ae9-81053845%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '680bc112d91b027c375a9eb6be12b0b79c0cdd87' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/breadcrumbs.tpl',
      1 => 1420488968,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142783672854a0ae457c9ae9-81053845',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54a0ae458532e1_87871541',
  'variables' => 
  array (
    'url_homepage' => 0,
    'items' => 0,
    'item' => 0,
    'url_base' => 0,
    'url_actual' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a0ae458532e1_87871541')) {function content_54a0ae458532e1_87871541($_smarty_tpl) {?><?php if (!is_callable('smarty_function_translate')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.translate.php';
?>
<nav class="breadcrumbs">
    <a href="<?php echo $_smarty_tpl->tpl_vars['url_homepage']->value;?>
" class="item"><?php echo smarty_function_translate(array('str'=>"Úvod"),$_smarty_tpl);?>
</a>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <a href="<?php if (!isset($_smarty_tpl->tpl_vars['item']->value['nazev_seo'])){?>#<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev_seo'];?>
<?php }?>" class="<?php if (!isset($_smarty_tpl->tpl_vars['item']->value['nazev_seo'])){?>unavailable<?php }?><?php if ((($_smarty_tpl->tpl_vars['url_base']->value).($_smarty_tpl->tpl_vars['item']->value['nazev_seo']))==$_smarty_tpl->tpl_vars['url_actual']->value){?> current<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
</a>
    <?php } ?>
</nav><?php }} ?>