<?php /* Smarty version Smarty-3.1.11, created on 2015-01-05 22:38:56
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/modules/hana/views/admin/admin_content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169522408054ab0470259655-67136777%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfae2c4030961637529b451f948a245c83fdfd90' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/modules/hana/views/admin/admin_content.tpl',
      1 => 1418594756,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169522408054ab0470259655-67136777',
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
  'unifunc' => 'content_54ab04702a1897_78309144',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ab04702a1897_78309144')) {function content_54ab04702a1897_78309144($_smarty_tpl) {?>
<div class="row">
    <div class="col-xs-12">
        <h2><?php echo $_smarty_tpl->tpl_vars['submodule_title']->value;?>
<?php if ($_smarty_tpl->tpl_vars['submodule_description']->value){?> <small><?php echo $_smarty_tpl->tpl_vars['submodule_description']->value;?>
</small><?php }?></h2>
    </div>
</div>
<?php echo $_smarty_tpl->tpl_vars['admin_content']->value;?>
<?php }} ?>