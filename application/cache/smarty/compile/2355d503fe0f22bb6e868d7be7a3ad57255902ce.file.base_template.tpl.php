<?php /* Smarty version Smarty-3.1.11, created on 2014-12-14 15:52:19
         compiled from "E:\Work\webs\orbcomm\application\views\base_template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14578548c7399232406-98467434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2355d503fe0f22bb6e868d7be7a3ad57255902ce' => 
    array (
      0 => 'E:\\Work\\webs\\orbcomm\\application\\views\\base_template.tpl',
      1 => 1418568678,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14578548c7399232406-98467434',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548c73993eb971_66073741',
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
<?php if ($_valid && !is_callable('content_548c73993eb971_66073741')) {function content_548c73993eb971_66073741($_smarty_tpl) {?><?php if (!is_callable('smarty_function_widget')) include 'E:\\Work\\webs\\orbcomm\\modules\\smarty\\plugins\\function.widget.php';
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
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,700,600,300,800' rel='stylesheet' type='text/css'>
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

              </div>
          </section>
      </div>
  </header>
  <?php echo smarty_function_widget(array('controller'=>'navigation','action'=>'main'),$_smarty_tpl);?>

  <section id="content">
      <?php echo $_smarty_tpl->tpl_vars['main_content']->value;?>

  </section>
  <footer id="main">
      <div class="row">
        <div class="small-8 text-left">
            Copyright <?php echo $_smarty_tpl->tpl_vars['web_owner']->value['copyright'];?>
 Orbcomm Czech republic s.r.o.
        </div>
        <div class="small-4 text-right">

        </div>
      </div>
  </footer>

  <?php if (!empty($_smarty_tpl->tpl_vars['web_owner']->value['ga_script'])){?>
      <?php echo $_smarty_tpl->tpl_vars['web_owner']->value['ga_script'];?>

  <?php }?>
  <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
/js/rem.js"></script>

  </body>
</html><?php }} ?>