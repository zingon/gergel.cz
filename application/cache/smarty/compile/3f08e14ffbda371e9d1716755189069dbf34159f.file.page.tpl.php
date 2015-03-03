<?php /* Smarty version Smarty-3.1.11, created on 2014-12-13 20:25:44
         compiled from "E:\Work\webs\orbcomm\application\views\page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16315548c92b8dfca03-46121670%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f08e14ffbda371e9d1716755189069dbf34159f' => 
    array (
      0 => 'E:\\Work\\webs\\orbcomm\\application\\views\\page.tpl',
      1 => 1417799188,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16315548c92b8dfca03-46121670',
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
  'unifunc' => 'content_548c92b8ec30c3_29872403',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548c92b8ec30c3_29872403')) {function content_548c92b8ec30c3_29872403($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include 'E:\\Work\\webs\\orbcomm\\modules\\smarty\\plugins\\function.widget.php';
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