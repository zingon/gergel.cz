<?php /* Smarty version Smarty-3.1.11, created on 2015-02-13 16:48:53
         compiled from "/var/www/orbcomm.cz/domains/www/application/views/catalog/category_homepage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166987824954de1ce5f382e3-16799101%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72b05261708517f1f34eae6094ab28c515dc2dec' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/application/views/catalog/category_homepage.tpl',
      1 => 1423822082,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166987824954de1ce5f382e3-16799101',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
    'items' => 0,
    'product' => 0,
    'url_base' => 0,
    'media_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54de1ce6082526_05488156',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54de1ce6082526_05488156')) {function content_54de1ce6082526_05488156($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.widget.php';
if (!is_callable('smarty_function_translate')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.translate.php';
?><div id="page-catalog" class="top-shadow list">
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
            <ul class="medium-block-grid-4 small-block-grid-2" id="product-list">
                <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
                    <li class="text-center">
                        <?php if ($_smarty_tpl->tpl_vars['product']->value['photo_src']){?>
                            <div class="photo display-table">
                                <div class="display-row">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['product']->value['nazev_seo'];?>
">
                                        <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/catalog/category/images-<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['photo_src'];?>
-t1.png" alt="<?php echo $_smarty_tpl->tpl_vars['product']->value['nazev'];?>
" data-white="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/catalog/category/images-<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['photo_src'];?>
-t1.png" data-red="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/catalog/category/images-<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['sec_src'];?>
-t1.png">
                                    </a>
                                </div>
                            </div>
                        <?php }?>
                        <h3 class="text-center"><?php echo $_smarty_tpl->tpl_vars['product']->value['nazev'];?>
</h3>
                        <p class="text-justify"><?php echo $_smarty_tpl->tpl_vars['product']->value['uvodni_popis'];?>
</p>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['product']->value['nazev_seo'];?>
" class="button red radius small no-border more">
                            <?php echo smarty_function_translate(array('str'=>"detail"),$_smarty_tpl);?>

                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div><?php }} ?>