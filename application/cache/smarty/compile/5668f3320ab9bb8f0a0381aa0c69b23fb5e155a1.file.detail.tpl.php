<?php /* Smarty version Smarty-3.1.11, created on 2015-01-05 21:28:44
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/page/detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:120552112154aaf3fc5442e1-69091963%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5668f3320ab9bb8f0a0381aa0c69b23fb5e155a1' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/page/detail.tpl',
      1 => 1420488966,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120552112154aaf3fc5442e1-69091963',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54aaf3fc5883c6_57513001',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54aaf3fc5883c6_57513001')) {function content_54aaf3fc5883c6_57513001($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.widget.php';
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