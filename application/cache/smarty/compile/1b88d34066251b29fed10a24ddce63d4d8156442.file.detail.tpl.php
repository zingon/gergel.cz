<?php /* Smarty version Smarty-3.1.11, created on 2015-01-21 23:10:11
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/contact/detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:113830045254aaf411056c09-25010638%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b88d34066251b29fed10a24ddce63d4d8156442' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/contact/detail.tpl',
      1 => 1421013768,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113830045254aaf411056c09-25010638',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54aaf4110a8b40_49781766',
  'variables' => 
  array (
    'item' => 0,
    'errors' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54aaf4110a8b40_49781766')) {function content_54aaf4110a8b40_49781766($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.widget.php';
if (!is_callable('smarty_function_translate')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.translate.php';
if (!is_callable('smarty_function_hana_secured_post')) include '/var/www/dgsbeta.cz/domains/orbcomm/modules/smarty/plugins/function.hana_secured_post.php';
?><div id="page-contact" class="top-shadow detail">
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
            <?php echo $_smarty_tpl->tpl_vars['item']->value['popis'];?>

        </div>
    </div>
    <div class="row">
        <div class="small-6 column">
            <p>GPS <?php echo smarty_function_translate(array('str'=>"souřadnice"),$_smarty_tpl);?>
: N 49° 13.620', E 17° 40.696'</p>
            <div id="map" class="radius">
            </div>
        </div>
        <div class="small-6 column">
            <h3><?php echo smarty_function_translate(array('str'=>"Kontaktní formulář"),$_smarty_tpl);?>
</h3>
            <form action="?" method="post">
                <div class="row">
                    <div class="large-6 medium-12 small-6 columns">
                        <input type="text" name="contactform[jmeno]" class="<?php if (isset($_smarty_tpl->tpl_vars['errors']->value['jmeno'])){?>error<?php }?> radius" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['jmeno'])){?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value['jmeno'];?>
"<?php }?> placeholder="Jméno" required>
                        <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['jmeno'])){?><small class="error">Chybné jméno</small><?php }?>
                    </div>
                    <div class="large-6 medium-12 small-6 columns">
                        <input type="text" name="contactform[prijmeni]" class="<?php if (isset($_smarty_tpl->tpl_vars['errors']->value['prijmeni'])){?>error<?php }?> radius" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['prijmeni'])){?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value['prijmeni'];?>
"<?php }?> placeholder="Příjmení" required>
                        <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['prijmeni'])){?><small class="error">Chybné příjmení</small><?php }?>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 medium-12 small-6 columns">
                        <input type="email" name="contactform[email]" class="<?php if (isset($_smarty_tpl->tpl_vars['errors']->value['email'])){?>error<?php }?> radius" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['email'])){?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
"<?php }?> placeholder="Email" required>
                        <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['email'])){?><small class="error">Chybný email</small><?php }?>
                    </div>
                    <div class="large-6 medium-12 small-6 columns">
                        <input type="tel" name="contactform[telefon]" class="<?php if (isset($_smarty_tpl->tpl_vars['errors']->value['telefon'])){?>error<?php }?> radius" <?php if (isset($_smarty_tpl->tpl_vars['data']->value['telefon'])){?>value="<?php echo $_smarty_tpl->tpl_vars['data']->value['telefon'];?>
"<?php }?> placeholder="Telefon">
                        <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['telefon'])){?><small class="error">Chybný telefon</small><?php }?>
                    </div>
                </div>
                <textarea rows="6" name="contactform[zprava]" class="<?php if (isset($_smarty_tpl->tpl_vars['errors']->value['zprava'])){?>error<?php }?> radius" required> <?php if (isset($_smarty_tpl->tpl_vars['data']->value['zprava'])){?><?php echo $_smarty_tpl->tpl_vars['data']->value['zprava'];?>
<?php }?></textarea>
                <?php if (isset($_smarty_tpl->tpl_vars['errors']->value['zprava'])){?><small class="error">Chybí zpráva</small><?php }?>

                <?php echo smarty_function_hana_secured_post(array('action'=>"send",'module'=>"contact"),$_smarty_tpl);?>

                <input type="text" name="kontrolni_cislo" value="" class="hidden-for-small-up" >
                <button type="submit" name="send" class="button right red tiny radius no-border">ODESLAT DOTAZ</button>
            </form>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
    $(function(){
        init_map();
    });
</script><?php }} ?>