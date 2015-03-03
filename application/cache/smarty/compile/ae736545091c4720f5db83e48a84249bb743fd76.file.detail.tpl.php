<?php /* Smarty version Smarty-3.1.11, created on 2014-12-14 13:27:20
         compiled from "E:\Work\webs\orbcomm\application\views\article\detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14454548d8228ec42e7-45127527%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae736545091c4720f5db83e48a84249bb743fd76' => 
    array (
      0 => 'E:\\Work\\webs\\orbcomm\\application\\views\\article\\detail.tpl',
      1 => 1418560028,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14454548d8228ec42e7-45127527',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
    'gallery' => 0,
    'media_path' => 0,
    'url_base' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548d822910ade2_32068853',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548d822910ade2_32068853')) {function content_548d822910ade2_32068853($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include 'E:\\Work\\webs\\orbcomm\\modules\\smarty\\plugins\\function.widget.php';
if (!is_callable('smarty_function_translate')) include 'E:\\Work\\webs\\orbcomm\\modules\\smarty\\plugins\\function.translate.php';
?>
<section id="page-article-detail">
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
            <?php $_smarty_tpl->_capture_stack[0][] = array('default', "gallery", null); ob_start(); ?><?php echo smarty_function_widget(array('controller'=>"gallery",'action'=>"default_widget",'param'=>"ad-t1"),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
            <?php if (strlen($_smarty_tpl->tpl_vars['gallery']->value)>0){?>
            <div class="row">
                <div class="medium-5 columns">
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['photo_src']){?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/article/item/images-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['photo_src'];?>
-t1.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['nadpis'];?>
" class="left main">
                    <?php }?>
                    <?php if (strlen($_smarty_tpl->tpl_vars['gallery']->value)>0){?>
                    <div id="gallery">
                        <?php echo $_smarty_tpl->tpl_vars['gallery']->value;?>

                    </div>
                </div>
                <div class="medium-7 columns">
                    <?php }?>
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['popis'];?>

                    <?php if (strlen($_smarty_tpl->tpl_vars['gallery']->value)>0){?>
                </div>
            </div>
            <?php }?>
        </div>
    </article>
    <section class="row">
        <div class="small-12 column">
            <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo smarty_function_translate(array('str'=>"tipy-a-zajimavosti"),$_smarty_tpl);?>
" class="button back"><?php echo smarty_function_translate(array('str'=>"ZPĚT NA SEZNAM TIPŮ"),$_smarty_tpl);?>
</a>
        </div>
    </section>
</section>

<?php }} ?>