<?php /* Smarty version Smarty-3.1.11, created on 2014-12-13 18:21:54
         compiled from "E:\Work\webs\orbcomm\modules\hana\views\admin\admin_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29246548c75b2191588-08762328%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b336ae9ca58ca01861a805fd2eded4f89d4a4c29' => 
    array (
      0 => 'E:\\Work\\webs\\orbcomm\\modules\\hana\\views\\admin\\admin_content.tpl',
      1 => 1417799219,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29246548c75b2191588-08762328',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'submodule_title' => 0,
    'submodule_description' => 0,
    'admin_content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548c75b2206233_92353751',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548c75b2206233_92353751')) {function content_548c75b2206233_92353751($_smarty_tpl) {?>
<div class="row">
    <div class="col-xs-12">
        <h2><?php echo $_smarty_tpl->tpl_vars['submodule_title']->value;?>
<?php if ($_smarty_tpl->tpl_vars['submodule_description']->value){?> <small><?php echo $_smarty_tpl->tpl_vars['submodule_description']->value;?>
</small><?php }?></h2>
    </div>
</div>
<?php echo $_smarty_tpl->tpl_vars['admin_content']->value;?>
<?php }} ?>