<?php /* Smarty version Smarty-3.1.11, created on 2015-02-13 13:47:19
         compiled from "/var/www/orbcomm.cz/domains/www/application/views/article/widget_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:72390615954ddf257abd7b9-55164304%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '740457a1e32961ea3b05ac3ee0986c05bb147b19' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/application/views/article/widget_list.tpl',
      1 => 1423822083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '72390615954ddf257abd7b9-55164304',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_base' => 0,
    'items' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54ddf257ae1400_23761802',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ddf257ae1400_23761802')) {function content_54ddf257ae1400_23761802($_smarty_tpl) {?><?php if (!is_callable('smarty_function_translate')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.translate.php';
?><div class="row" id="article-widget-list">
    <div class="small-12 column">
        <div class="row">
            <div class="small-8 columns">
                <h2><?php echo smarty_function_translate(array('str'=>"Aktuální novinky"),$_smarty_tpl);?>
</h2>
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