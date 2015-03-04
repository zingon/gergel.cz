<?php /* Smarty version Smarty-3.1.11, created on 2014-12-29 02:28:40
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35408872454a0ae486b3461-83338137%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b59fc873732be0b856dc7f1b040361a046ffc42d' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/page.tpl',
      1 => 1418594507,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35408872454a0ae486b3461-83338137',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
    'media_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54a0ae487137c7_52419954',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a0ae487137c7_52419954')) {function content_54a0ae487137c7_52419954($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.widget.php';
?>
<section id="page-common">
    <header class="row">
        <div class="medium-5 medium-push-7 columns medium-text-right">
            <?php echo smarty_function_widget(array('action'=>"breadcrumbs",'controller'=>"navigation"),$_smarty_tpl);?>

        </div>
        <div class="medium-7 medium-pull-5 columns">
            <h2><?php echo $_smarty_tpl->tpl_vars['item']->value['nadpis'];?>
</h2>
        </div>
    </header>
    <article class="row">
        <div class="small-12 column">
            <?php if ($_smarty_tpl->tpl_vars['item']->value['photo_src']){?>
                <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/page/item/images-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['photo_src'];?>
-t1.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['nadpis'];?>
" class="right main">
            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['item']->value['popis'];?>

        </div>
    </article>
</section>
<?php }} ?>