<?php /* Smarty version Smarty-3.1.11, created on 2014-12-14 12:37:04
         compiled from "E:\Work\webs\orbcomm\application\views\catalog\homepage_widget.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29675548d64945843b9-29821152%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a811c2ac5f02f160067f6eb074c80ee479e90449' => 
    array (
      0 => 'E:\\Work\\webs\\orbcomm\\application\\views\\catalog\\homepage_widget.tpl',
      1 => 1418557022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29675548d64945843b9-29821152',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548d64945856a2_42778250',
  'variables' => 
  array (
    'products' => 0,
    'url_base' => 0,
    'product' => 0,
    'media_path' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548d64945856a2_42778250')) {function content_548d64945856a2_42778250($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_romanic')) include 'E:\\Work\\webs\\orbcomm\\modules\\smarty\\plugins\\modifier.romanic.php';
if (!is_callable('smarty_function_translate')) include 'E:\\Work\\webs\\orbcomm\\modules\\smarty\\plugins\\function.translate.php';
?><div class="row" id="catalog-widget">
    <div class="small-12 column">
        <?php if (!empty($_smarty_tpl->tpl_vars['products']->value)){?>
            <div class="jcarousel-wrapper">
                <div class="jcarousel">
                    <ul>
                        <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['for_p']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['for_p']['iteration']++;
?>
                            <li>
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
photos/catalog/item/images-<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['sec_src'];?>
-t1.png" alt="<?php echo $_smarty_tpl->tpl_vars['product']->value['nazev'];?>
" data-red="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/catalog/item/images-<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['sec_src'];?>
-t1.png" data-white="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/catalog/item/images-<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['product']->value['photo_src'];?>
-t1.png">
                                            </a>
                                        </div>
                                    </div>
                                <?php }?>
                                <p><?php echo $_smarty_tpl->tpl_vars['product']->value['uvodni_popis'];?>
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