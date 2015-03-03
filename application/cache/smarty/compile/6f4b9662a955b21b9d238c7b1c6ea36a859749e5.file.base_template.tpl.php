<?php /* Smarty version Smarty-3.1.11, created on 2015-02-20 17:34:10
         compiled from "/var/www/orbcomm.cz/domains/www/application/views/base_template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:116046018454ddf257afe499-72661904%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f4b9662a955b21b9d238c7b1c6ea36a859749e5' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/application/views/base_template.tpl',
      1 => 1424450046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116046018454ddf257afe499-72661904',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54ddf257b7bd24_06835700',
  'variables' => 
  array (
    'web_owner' => 0,
    'page_keywords' => 0,
    'page_description' => 0,
    'media_path' => 0,
    'page_name' => 0,
    'page_title' => 0,
    'url_homepage' => 0,
    'main_content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ddf257b7bd24_06835700')) {function content_54ddf257b7bd24_06835700($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.widget.php';
if (!is_callable('smarty_function_translate')) include '/var/www/orbcomm.cz/domains/www/modules/smarty/plugins/function.translate.php';
?>

<!DOCTYPE html>
<html lang="cs">
  <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta name="copyright" content="<?php echo $_smarty_tpl->tpl_vars['web_owner']->value['copyright'];?>
" />
      <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['page_keywords']->value;?>
" />
      <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['page_description']->value;?>
 " />
      <meta name="robots" content="all,follow" />
      <meta name="googlebot" content="snippet,archive" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
css/normalize.css" rel="stylesheet" media="all" />
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700&amp;subset=latin-ext' rel='stylesheet' type='text/css'>
      <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
css/foundation-icons.css" rel="stylesheet" media="all" />
      <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
css/foundation.css" rel="stylesheet" media="all" />
      <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
css/helpers/jquery.fancybox-thumbs.css" rel="stylesheet" media="all" />
      <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
css/jquery.fancybox.css" rel="stylesheet" media="all" />
      <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
css/responsive-tables.css" rel="stylesheet" media="all" />
      <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
css/jcarousel.css" rel="stylesheet" media="all" />
      <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
css/fonts.css" rel="stylesheet" media="all" />
      <link type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
css/style.css" rel="stylesheet" media="all" />

      <!--[if lte IE 9]>
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
/js/jquery-1.11.1.min.js"></script>
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
/js/respond.min.js"></script>
      <![endif]-->
      <!--[if !IE]> -->
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
/js/jquery-2.1.1.min.js"></script>
      <!-- <![endif]-->
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
js/modernizr.min.js"></script>
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
js/jquery.fancybox.pack.js"></script>
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
js/helpers/jquery.fancybox-thumbs.js"></script>
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
js/foundation.min.js"></script>
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
js/responsive-tables.js"></script>
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
js/jcarousel.min.js"></script>
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
js/main.js"></script>

      <title><?php echo $_smarty_tpl->tpl_vars['page_name']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</title>
      
  </head>
  <body>
  <?php echo smarty_function_widget(array('controller'=>'site','action'=>'message'),$_smarty_tpl);?>

  <div id="relative-wrapper">
      <header class="row">
          <div class="small-12 column">
              <section class="row" id="top">
                  <div class="small-6 columns">
                      <a href="<?php echo $_smarty_tpl->tpl_vars['url_homepage']->value;?>
">
                          <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
img/logo.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['web_owner']->value['default_title'];?>
" id="main-logo">
                      </a>
                  </div>
                  <div class="small-6 columns">
                  		<a href="https://orbtrack.eu"><img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
img/portal.png"></a>
                  </div>
              </section>
          </div>
      </header>
      <?php echo smarty_function_widget(array('controller'=>'navigation','action'=>'main'),$_smarty_tpl);?>

      <section id="content">
          <?php echo $_smarty_tpl->tpl_vars['main_content']->value;?>

      </section>
      <footer>
          <div class="row">
              <div class="small-8 text-left columns">
                  Copyright <?php echo $_smarty_tpl->tpl_vars['web_owner']->value['copyright'];?>
 Orbcomm Czech republic s.r.o.
              </div>
              <div class="small-4 text-right columns dg">
                  <?php echo smarty_function_translate(array('str'=>"Realizace"),$_smarty_tpl);?>
: <a href="http://www.dgstudio.cz"><img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
img/dg_logo.png" alt="dg studio" title="DG Studio" id="dg-logo"></a>
              </div>
          </div>
      </footer>
  </div>


  <?php if (!empty($_smarty_tpl->tpl_vars['web_owner']->value['ga_script'])){?>
      <?php echo $_smarty_tpl->tpl_vars['web_owner']->value['ga_script'];?>

  <?php }?>
  <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
/js/rem.js"></script>

  </body>
</html><?php }} ?>