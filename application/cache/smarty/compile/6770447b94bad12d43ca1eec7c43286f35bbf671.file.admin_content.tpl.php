<?php /* Smarty version Smarty-3.1.11, created on 2015-02-17 15:03:43
         compiled from "/var/www/orbcomm.cz/domains/www/modules/hana/views/admin/admin_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3385692554e34a3f329de3-01905067%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6770447b94bad12d43ca1eec7c43286f35bbf671' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/modules/hana/views/admin/admin_content.tpl',
      1 => 1423822329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3385692554e34a3f329de3-01905067',
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
  'unifunc' => 'content_54e34a3f3b4f03_44811984',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e34a3f3b4f03_44811984')) {function content_54e34a3f3b4f03_44811984($_smarty_tpl) {?>
<div class="row">
    <div class="col-xs-12">
        <h2><?php echo $_smarty_tpl->tpl_vars['submodule_title']->value;?>
<?php if ($_smarty_tpl->tpl_vars['submodule_description']->value){?> <small><?php echo $_smarty_tpl->tpl_vars['submodule_description']->value;?>
</small><?php }?></h2>
    </div>
</div>
<?php echo $_smarty_tpl->tpl_vars['admin_content']->value;?>
<?php }} ?>