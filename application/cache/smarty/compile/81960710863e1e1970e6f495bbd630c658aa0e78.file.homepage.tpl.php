<?php /* Smarty version Smarty-3.1.11, created on 2015-02-13 13:47:19
         compiled from "/var/www/orbcomm.cz/domains/www/application/views/page/homepage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157612718154ddf2576f44e0-19151029%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81960710863e1e1970e6f495bbd630c658aa0e78' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/application/views/page/homepage.tpl',
      1 => 1423822083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157612718154ddf2576f44e0-19151029',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
    'media_path' => 0,
    'url_base' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54ddf257835807_56126870',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ddf257835807_56126870')) {function content_54ddf257835807_56126870($_smarty_tpl) {?><?php if (!is_callable('smarty_function_translate')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.translate.php';
if (!is_callable('smarty_function_widget')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.widget.php';
if (!is_callable('smarty_function_static_content')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.static_content.php';
?><div id="page-homepage" class="top-shadow">
    <div class="row-full" id="info">
        <div class="row">
            <?php if ($_smarty_tpl->tpl_vars['item']->value['photo_src']){?>
            <div class="medium-7 columns">
                <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
photos/page/item/images-<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value['photo_src'];?>
-t1.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
">
            </div>
            <?php }?>
            <div class="medium-<?php if ($_smarty_tpl->tpl_vars['item']->value['photo_src']){?>5<?php }else{ ?>12<?php }?> columns">
                <h3><?php echo $_smarty_tpl->tpl_vars['item']->value['nadpis'];?>
</h3>
                <?php echo $_smarty_tpl->tpl_vars['item']->value['popis'];?>

                <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
img/homepage-arrow.png" alt="<?php echo smarty_function_translate(array('str'=>"MÁM ZÁJEM O INFORMACE"),$_smarty_tpl);?>
" class="left">
                <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
kontakt" class="button right red radius"><?php echo smarty_function_translate(array('str'=>"MÁM ZÁJEM O INFORMACE"),$_smarty_tpl);?>
</a>
            </div>
        </div>
    </div>
    <div class="row-full" id="products">
        <?php echo smarty_function_widget(array('controller'=>'catalog','action'=>'homepage_widget'),$_smarty_tpl);?>

    </div>
    <div class="row-full" id="news">
        <?php echo smarty_function_widget(array('controller'=>'article','action'=>'homepage_banner_list'),$_smarty_tpl);?>

    </div>

    <div class="row" id="why-we">
        <div class="small-12 column">
            <div class="row">
                <div class="small-12 column">
                    <h3><?php echo smarty_function_translate(array('str'=>"Proč právě my"),$_smarty_tpl);?>
?</h3>
                </div>
            </div>
            <div class="row">
                <div class="medium-6 columns">
                    <div class="box">
                        <div class="inner">
                            <?php echo smarty_function_static_content(array('code'=>"homepage-box"),$_smarty_tpl);?>

                        </div>
                    </div>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
materialy-a-sluzby" class="button red radius right">
                        <?php echo smarty_function_translate(array('str'=>"CHCI VÍCE INFORMACÍ"),$_smarty_tpl);?>

                    </a>
                </div>
                <div class="medium-6 columns">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
img/homepage-bulb.jpg" alt="" class="hide-for-small-down">
                </div>
            </div>
        </div>
    </div>
    <div class="row-full" id="google-map">
        <div id="map"></div>
        <div class="box hide-for-small-down" id="info-box">
            <?php echo smarty_function_static_content(array('code'=>"homepage-contact"),$_smarty_tpl);?>

        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
    google_map();
</script><?php }} ?>