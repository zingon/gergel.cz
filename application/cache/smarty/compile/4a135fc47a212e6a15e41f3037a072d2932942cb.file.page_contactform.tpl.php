<?php /* Smarty version Smarty-3.1.11, created on 2014-12-13 20:51:35
         compiled from "E:\Work\webs\orbcomm\application\views\page_contactform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6274548c98c728a969-33343915%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a135fc47a212e6a15e41f3037a072d2932942cb' => 
    array (
      0 => 'E:\\Work\\webs\\orbcomm\\application\\views\\page_contactform.tpl',
      1 => 1417799188,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6274548c98c728a969-33343915',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548c98c730cf26_72621683',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548c98c730cf26_72621683')) {function content_548c98c730cf26_72621683($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include 'E:\\Work\\webs\\orbcomm\\modules\\smarty\\plugins\\function.widget.php';
?>

<section id="page-contact">
    <header class="row">
        <div class="medium-5 medium-push-7 columns medium-text-right">
            <?php echo smarty_function_widget(array('action'=>"breadcrumbs",'controller'=>"navigation"),$_smarty_tpl);?>

        </div>
        <div class="medium-7 medium-pull-5 columns">
            <h2><?php echo $_smarty_tpl->tpl_vars['item']->value['nadpis'];?>
</h2>
        </div>
    </header>
    <article class="row">
        <div class="medium-6 columns">
            <h3>Sídlo společnosti</h3>
            <?php echo $_smarty_tpl->tpl_vars['item']->value['popis'];?>

        </div>
        <div class="medium-6 columns">
            <h3>Kontaktní formulář</h3>
            <?php echo smarty_function_widget(array('action'=>"show",'controller'=>"contact"),$_smarty_tpl);?>

        </div>
    </article>
    <div class="row">
        <div class="small-12 column">
            <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
            <div id="google-map"></div>
            <script type="text/javascript">init_gmap("google-map")</script>
        </div>
    </div>
</section>
<?php }} ?>