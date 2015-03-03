<?php /* Smarty version Smarty-3.1.11, created on 2015-01-12 15:15:38
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/catalog/detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:71587425754b2f3edb25d52-13543422%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '072fde0ab3ae71d0f28a03b8984e6a8156ca5b81' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/catalog/detail.tpl',
      1 => 1421072106,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71587425754b2f3edb25d52-13543422',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54b2f3edba0458_79412712',
  'variables' => 
  array (
    'item' => 0,
    'media_path' => 0,
    'url_base' => 0,
    'prev' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b2f3edba0458_79412712')) {function content_54b2f3edba0458_79412712($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.widget.php';
if (!is_callable('smarty_function_translate')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.translate.php';
?><div id="page-catalog" class="top-shadow detail">
    <header class="row-full">
        <div class="row">
            <div class="small-4 medium-6 column">
                <h1><?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
</h1>
            </div>
            <div class="small-8 medium-6 column text-right">
                <?php echo smarty_function_widget(array('action'=>"breadcrumbs",'controller'=>"navigation"),$_smarty_tpl);?>

            </div>
        </div>
    </header>
    <div class="row">
        <div class="medium-4 columns">
            <?php echo smarty_function_widget(array('controller'=>'catalog','action'=>'second_subnav'),$_smarty_tpl);?>

        </div>
        <div class="medium-8 columns">
            <?php if ($_smarty_tpl->tpl_vars['item']->value['sec_src']){?>
                <aside class="main-photo display-table">
                    <div class="display-row">
                        <div class="display-cell">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/catalog/category/images-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['sec_src'];?>
-t2.png" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
 photo">
                        </div>
                    </div>
                </aside>
            <?php }?>
            <p class="uvodni-popis"><?php echo $_smarty_tpl->tpl_vars['item']->value['uvodni_popis'];?>
</p>
            <?php echo $_smarty_tpl->tpl_vars['item']->value['popis'];?>

            <div class="row">
                <div class="small-12 column">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['prev']->value['nazev_seo'];?>
" class="button red tiny radius more right">
                        <?php echo smarty_function_translate(array('str'=>"zpět"),$_smarty_tpl);?>

                    </a>
                </div>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['item']->value['contact_form']){?>
                <div class="row">
                    <div class="small-12 column">
                        <h3><?php echo smarty_function_translate(array('str'=>"Kontaktní formulář"),$_smarty_tpl);?>
</h3>
                        <?php echo smarty_function_widget(array('controller'=>'contact','action'=>'show'),$_smarty_tpl);?>

                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</div><?php }} ?>