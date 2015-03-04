<?php /* Smarty version Smarty-3.1.11, created on 2015-02-13 16:47:26
         compiled from "/var/www/orbcomm.cz/domains/www/application/views/page/detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104188960254de1c8eabf353-39442082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6758fe18f871a5a9ff3b0a0d9d720e0e9e73a4f5' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/application/views/page/detail.tpl',
      1 => 1423822083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104188960254de1c8eabf353-39442082',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54de1c8eb23f07_15087927',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54de1c8eb23f07_15087927')) {function content_54de1c8eb23f07_15087927($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.widget.php';
?><div id="page-detail" class="top-shadow">
    <header class="row-full">
        <div class="row">
            <div class="small-6 column">
                <h1><?php echo $_smarty_tpl->tpl_vars['item']->value['nadpis'];?>
</h1>
            </div>
            <div class="small-6 column text-right">
                <?php echo smarty_function_widget(array('action'=>"breadcrumbs",'controller'=>"navigation"),$_smarty_tpl);?>

            </div>
        </div>
    </header>
    <div class="row">
        <div class="small-12 column">
            <?php echo $_smarty_tpl->tpl_vars['item']->value['popis'];?>

        </div>
    </div>
</div><?php }} ?>