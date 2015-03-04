<?php /* Smarty version Smarty-3.1.11, created on 2015-02-13 16:48:41
         compiled from "/var/www/orbcomm.cz/domains/www/application/views/article/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:108195133754de1cd9b21771-17201147%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b888d1e5d3f236044bdf288041f9d76ba77c2e35' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/application/views/article/list.tpl',
      1 => 1423822083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108195133754de1cd9b21771-17201147',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
    'items' => 0,
    'media_path' => 0,
    'url_base' => 0,
    'pagination' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54de1cd9bf98c8_08480855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54de1cd9bf98c8_08480855')) {function content_54de1cd9bf98c8_08480855($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.widget.php';
if (!is_callable('smarty_modifier_date')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/modifier.date.php';
if (!is_callable('smarty_function_translate')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.translate.php';
?>
<div id="page-article" class="list top-shadow">
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
            <?php if (count($_smarty_tpl->tpl_vars['items']->value)>0){?>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                    <article class="row">
                        <?php if ($_smarty_tpl->tpl_vars['item']->value['photo_src']){?>
                            <div class="small-2 columns">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/article/item/images-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['photo_src'];?>
-t1.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
 photo">
                            </div>
                        <?php }?>
                        <div class="small-<?php if ($_smarty_tpl->tpl_vars['item']->value['photo_src']){?>10<?php }else{ ?>12<?php }?> column">
                            <div class="row">
                                <div class="small-8 columns">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev_seo'];?>
"><h4><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['item']->value['nazev'], 'UTF-8');?>
</h4></a>
                                </div>
                                <div class="small-4 columns text-right">
                                    <time datetime="<?php echo $_smarty_tpl->tpl_vars['item']->value['date'];?>
"><?php echo smarty_modifier_date($_smarty_tpl->tpl_vars['item']->value['date'],'cz');?>
</time>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 columns">
                                    <?php echo $_smarty_tpl->tpl_vars['item']->value['uvodni_popis'];?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="small-12 column text-right">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev_seo'];?>
" class="button red tiny radius more right">
                                        <?php echo smarty_function_translate(array('str'=>"více"),$_smarty_tpl);?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php } ?>
                <?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

            <?php }?>
        </div>
    </div>
</div>


<?php }} ?>