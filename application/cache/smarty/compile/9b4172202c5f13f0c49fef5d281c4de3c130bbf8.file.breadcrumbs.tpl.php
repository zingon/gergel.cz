<?php /* Smarty version Smarty-3.1.11, created on 2014-12-13 20:25:44
         compiled from "E:\Work\webs\orbcomm\application\views\breadcrumbs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19672548c92b8f2ac60-74622041%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b4172202c5f13f0c49fef5d281c4de3c130bbf8' => 
    array (
      0 => 'E:\\Work\\webs\\orbcomm\\application\\views\\breadcrumbs.tpl',
      1 => 1417799187,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19672548c92b8f2ac60-74622041',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_homepage' => 0,
    'items' => 0,
    'item' => 0,
    'url_base' => 0,
    'url_actual' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548c92b90ff5b4_28927186',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548c92b90ff5b4_28927186')) {function content_548c92b90ff5b4_28927186($_smarty_tpl) {?><?php if (!is_callable('smarty_function_translate')) include 'E:\\Work\\webs\\orbcomm\\modules\\smarty\\plugins\\function.translate.php';
?>
<nav class="breadcrumbs">
    <a href="<?php echo $_smarty_tpl->tpl_vars['url_homepage']->value;?>
" class="item"><?php echo smarty_function_translate(array('str'=>"Úvod"),$_smarty_tpl);?>
</a>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['bread']['last'] = $_smarty_tpl->tpl_vars['item']->last;
?>
        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['bread']['last']){?><?php break 1?><?php }?>
        <a href="<?php if (!isset($_smarty_tpl->tpl_vars['item']->value['nazev_seo'])){?>#<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev_seo'];?>
<?php }?>" class="<?php if (!isset($_smarty_tpl->tpl_vars['item']->value['nazev_seo'])){?>unavailable<?php }?><?php if ((($_smarty_tpl->tpl_vars['url_base']->value).($_smarty_tpl->tpl_vars['item']->value['nazev_seo']))==$_smarty_tpl->tpl_vars['url_actual']->value){?> current<?php }?>"><?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
</a>
    <?php } ?>
</nav><?php }} ?>