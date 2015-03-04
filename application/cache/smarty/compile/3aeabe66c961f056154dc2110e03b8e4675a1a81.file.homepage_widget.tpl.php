<?php /* Smarty version Smarty-3.1.11, created on 2015-01-21 22:39:28
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/catalog/homepage_widget.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28876041154a0ade64a3df9-53954956%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3aeabe66c961f056154dc2110e03b8e4675a1a81' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/catalog/homepage_widget.tpl',
      1 => 1421876364,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28876041154a0ade64a3df9-53954956',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54a0ade6553f58_91363556',
  'variables' => 
  array (
    'products' => 0,
    'url_base' => 0,
    'product' => 0,
    'media_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a0ade6553f58_91363556')) {function content_54a0ade6553f58_91363556($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_romanic')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/modifier.romanic.php';
if (!is_callable('smarty_function_translate')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.translate.php';
?><div class="row" id="catalog-widget">
    <div class="small-12 column">
        <?php if (!empty($_smarty_tpl->tpl_vars['products']->value)){?>
            <div class="jcarousel-wrapper">
                <div class="jcarousel">
                    <ul id="product-list">
                        <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['for_p']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['for_p']['iteration']++;
?>
                            <li data-equalizer>
                                <span class="number">
                                    <?php echo smarty_modifier_romanic($_smarty_tpl->getVariable('smarty')->value['foreach']['for_p']['iteration']);?>
.
                                </span>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['product']->value['nazev_seo'];?>
"><h4><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['product']->value['nazev'], 'UTF-8');?>
</h4></a>
                                <?php if ($_smarty_tpl->tpl_vars['product']->value['photo_src']){?>
                                    <div class="photo display-table">
                                        <div class="display-row">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['product']->value['nazev_seo'];?>
">
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/catalog/category/images-<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['sec_src'];?>
-t1.png" alt="<?php echo $_smarty_tpl->tpl_vars['product']->value['nazev'];?>
" data-red="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/catalog/category/images-<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['sec_src'];?>
-t1.png" data-white="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/catalog/category/images-<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['photo_src'];?>
-t1.png">
                                            </a>
                                        </div>
                                    </div>
                                <?php }?>
                                <p class="text-justify" data-equalizer-watch><?php echo $_smarty_tpl->tpl_vars['product']->value['uvodni_popis'];?>
</p>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['product']->value['nazev_seo'];?>
" class="button red radius small no-border">
                                    <?php echo smarty_function_translate(array('str'=>"MÁM ZÁJEM O INFORMACE"),$_smarty_tpl);?>

                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <a href="#" class="jcarousel-control-prev jcarousel-control">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
img/left-big-arrow.png" alt="<?php echo smarty_function_translate(array('str'=>"předchozí"),$_smarty_tpl);?>
">
                </a>
                <a href="#" class="jcarousel-control-next jcarousel-control">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
img/right-big-arrow.png" alt="<?php echo smarty_function_translate(array('str'=>"další"),$_smarty_tpl);?>
">
                </a>
            </div>
        <?php }?>
    </div>
</div><?php }} ?>