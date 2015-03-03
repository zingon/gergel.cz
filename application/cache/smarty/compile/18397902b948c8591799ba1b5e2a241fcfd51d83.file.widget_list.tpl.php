<?php /* Smarty version Smarty-3.1.11, created on 2014-12-14 00:41:07
         compiled from "E:\Work\webs\orbcomm\application\views\article\widget_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:361548cc535bba0d4-59755312%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18397902b948c8591799ba1b5e2a241fcfd51d83' => 
    array (
      0 => 'E:\\Work\\webs\\orbcomm\\application\\views\\article\\widget_list.tpl',
      1 => 1418514066,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '361548cc535bba0d4-59755312',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548cc535bc1103_02282554',
  'variables' => 
  array (
    'url_base' => 0,
    'items' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548cc535bc1103_02282554')) {function content_548cc535bc1103_02282554($_smarty_tpl) {?><?php if (!is_callable('smarty_function_translate')) include 'E:\\Work\\webs\\orbcomm\\modules\\smarty\\plugins\\function.translate.php';
?><div class="row" id="article-widget-list">
    <div class="small-12 column">
        <div class="row">
            <div class="small-8 columns">
                <h3><?php echo smarty_function_translate(array('str'=>"Aktuální novinky"),$_smarty_tpl);?>
</h3>
            </div>
            <div class="small-4 columns">
                <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
aktualni-novinky" class="button red radius tiny right continue">
                    <?php echo smarty_function_translate(array('str'=>"SEZNAM NOVINEK"),$_smarty_tpl);?>

                </a>
            </div>
        </div>
        <div class="row list">
            <div class="small-12 column">
                <ul class="medium-block-grid-2 small-block-grid-1">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <li>
                            <div>
                                <?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>

                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev_seo'];?>
" class="button red tiny radius more right">
                                    <?php echo smarty_function_translate(array('str'=>"více"),$_smarty_tpl);?>

                                </a>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div><?php }} ?>