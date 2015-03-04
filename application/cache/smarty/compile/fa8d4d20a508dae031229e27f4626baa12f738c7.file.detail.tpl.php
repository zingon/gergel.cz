<?php /* Smarty version Smarty-3.1.11, created on 2015-02-03 01:28:02
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/article/detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:113713806854a0ae45685578-95476741%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa8d4d20a508dae031229e27f4626baa12f738c7' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/article/detail.tpl',
      1 => 1422820418,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113713806854a0ae45685578-95476741',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54a0ae4579bbe2_72988214',
  'variables' => 
  array (
    'item' => 0,
    'media_path' => 0,
    'url_base' => 0,
    'prev' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a0ae4579bbe2_72988214')) {function content_54a0ae4579bbe2_72988214($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.widget.php';
if (!is_callable('smarty_modifier_date')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/modifier.date.php';
if (!is_callable('smarty_function_translate')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.translate.php';
?>
<div id="page-article" class="detail top-shadow">
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
    <article class="row">
        <div class="small-12 column">
            <div class="row">
                <div class="small-12 column">
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['photo_src']){?>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/article/item/images-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['photo_src'];?>
-t2.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
 photo" class="left main">
                    <?php }?>
                    <time datetime="<?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
"><?php echo smarty_modifier_date($_smarty_tpl->tpl_vars['item']->value['date'],'cz');?>
</time>
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['uvodni_popis']){?>
                        <div class="uvodni-popis <?php if (!$_smarty_tpl->tpl_vars['item']->value['photo_src']){?>arrow<?php }?>">
                            <?php echo $_smarty_tpl->tpl_vars['item']->value['uvodni_popis'];?>

                        </div>
                    <?php }?>
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['popis'];?>

                </div>
            </div>
            <div class="row">
                <div class="small-12 column">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['prev']->value['nazev_seo'];?>
" class="button red tiny radius more right">
                        <?php echo smarty_function_translate(array('str'=>"zpět"),$_smarty_tpl);?>

                    </a>
                </div>
            </div>
        </div>
    </article>
</div><?php }} ?>