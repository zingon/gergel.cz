<?php /* Smarty version Smarty-3.1.11, created on 2014-12-13 18:21:45
         compiled from "E:\Work\webs\orbcomm\modules\hana\views\admin\base_template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1472548c75a9c870f0-85502848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5adbba7edf7bdd9ff6c66c679c04350afebfaf53' => 
    array (
      0 => 'E:\\Work\\webs\\orbcomm\\modules\\hana\\views\\admin\\base_template.tpl',
      1 => 1417799219,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1472548c75a9c870f0-85502848',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'media_path' => 0,
    'title' => 0,
    'url_base' => 0,
    'admin_menu_L1_L2' => 0,
    'web_owner' => 0,
    'link' => 0,
    'role_level' => 0,
    'child' => 0,
    'admin_menu_L2' => 0,
    'center_section' => 0,
    'admin_menu_L3' => 0,
    'admin_content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_548c75aa184d18_22920826',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548c75aa184d18_22920826')) {function content_548c75aa184d18_22920826($_smarty_tpl) {?>
<!DOCTYPE html>
<html lang=cs>	
  <head>		
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />		
    <meta name="author" content="Pavel Herink" />		
    <meta name="copyright" content="2011" />		
    <meta name="description" content="Systém pro správu obsahu Hana verze 2" />		
    <meta name="keywords" content="" />	
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    	
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/css/style-print.css" type="text/css" media="print" />
      <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/css/jquery-ui-1.8.6.custom.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/css/showLoading.css" type="text/css" media="screen" />
      <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/css/agile-uploader.css" type="text/css" media="screen" />


    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/jquery-lightbox/css/jquery.lightbox.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/css/bootstrap-datetimepicker.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/css/bootstrap-colorpicker.min.css" type="text/css" />
      

      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/jquery-1.7.1.min.js"></script>
      <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/jquery-ui-1.8.18.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/ckeditor/ckeditor.js"></script>

    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/locales/bootstrap-datetimepicker.cs.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/daterangepicker.jQuery.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/jquery.showLoading.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/jquery.tristateCheckbox.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/jquery.tablednd.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/jquery-lightbox/js/jquery.lightbox.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/jquery.uploadify.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/admin.js"></script>
    
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 - administrační rozhranní</title>	
    
    <script type="text/javascript">
    /* <![CDATA[ */ 
    $(function(){
     $.Lightbox.construct({
        "base_url":    "<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
"  
    });


    /* ]]> */

    });
    </script>
          <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart', 'geochart']});
    </script>
      
  </head>
  <body>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
		  <!-- hlavicka -->
		      <header>
			<!--  hlavni menu L1 -->
                <?php if (!empty($_smarty_tpl->tpl_vars['admin_menu_L1_L2']->value)){?>				
	              <nav class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
" data-toggle="popover" data-trigger="hover" data-content="You will be redirected to the frontend."><?php echo $_smarty_tpl->tpl_vars['web_owner']->value['default_title'];?>
</a>
                    </div>
                    <div class="collapse navbar-collapse" id="main-navbar-collapse-1">
                        <ul class="navbar-nav nav">
                        <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['admin_menu_L1_L2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['link']->key;
?>
                            <?php if ($_smarty_tpl->tpl_vars['link']->value['global_access_level']<=$_smarty_tpl->tpl_vars['role_level']->value){?>
                                <li class="<?php if ($_smarty_tpl->tpl_vars['link']->value['has_childs']){?>dropdown <?php }?><?php if (isset($_smarty_tpl->tpl_vars['link']->value['sel'])){?>active<?php }?>">
                                    <a href="<?php if ($_smarty_tpl->tpl_vars['link']->value['has_childs']){?>#<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['link']->value['href'];?>
<?php }?>" <?php if ($_smarty_tpl->tpl_vars['link']->value['has_childs']){?>class="dropdown-toggle" data-toggle="dropdown"<?php }?>><?php echo $_smarty_tpl->tpl_vars['link']->value['nazev'];?>
 <?php if ($_smarty_tpl->tpl_vars['link']->value['has_childs']){?><b class="caret"></b><?php }?></a>
                                    <?php if ($_smarty_tpl->tpl_vars['link']->value['has_childs']){?>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['link']->value['nazev'];?>
</a></li>
                                            <li class="divider"></li>
                                            <?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['child']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['link']->value['childs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
$_smarty_tpl->tpl_vars['child']->_loop = true;
?>
                                            <li class="<?php if (isset($_smarty_tpl->tpl_vars['child']->value['sel'])){?>active<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['child']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['child']->value['nazev'];?>
</a>
                                            <?php } ?>
                                        </ul>
                                    <?php }?>
                                </li>
                                
                            <?php }?>
                        <?php } ?>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            
                            <li><a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
admin/logout">Odhlásit</a></li>
                        </ul>
                    </div>   
		          </nav>
	            <?php }?>	
		      </header>
		  </div>
        </div>
		<!-- submenu L2 -->
		<?php if (!empty($_smarty_tpl->tpl_vars['admin_menu_L2']->value)){?>
		<div id="SubnavSection">			
  		<ul>
        <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['admin_menu_L2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['link']->key;
?>
          <?php if ($_smarty_tpl->tpl_vars['link']->value['global_access_level']<=$_smarty_tpl->tpl_vars['role_level']->value){?>
          <li>
            <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value['href'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['link']->value['sel'])){?>class="sel"<?php }?>><?php echo $_smarty_tpl->tpl_vars['link']->value['nazev'];?>
</a>
          </li>
          <?php }?>
        <?php } ?>
  		</ul>
		</div>
		<?php }?>
		
		<!-- stredni cast -->	
		<div class="row">	
		  <?php if (!empty($_smarty_tpl->tpl_vars['center_section']->value)){?><?php echo $_smarty_tpl->tpl_vars['center_section']->value;?>
<?php }?>		  
		  <!-- leve menu -->
  		  <?php if (!empty($_smarty_tpl->tpl_vars['admin_menu_L3']->value)){?> 
         
		  <div class="col-md-2 sidebar-offcanvas">
              <div class="well">
            <ul class="nav nav-pills nav-stacked">
    		      <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['admin_menu_L3']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['link']->key;
?>
    			     <?php if ($_smarty_tpl->tpl_vars['link']->value['global_access_level']<=$_smarty_tpl->tpl_vars['role_level']->value){?>
                         <li <?php if (isset($_smarty_tpl->tpl_vars['link']->value['sel'])){?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value['href'];?>
"><?php echo $_smarty_tpl->tpl_vars['link']->value['nazev'];?>
</a></li>
                    <?php }?>
                  <?php } ?> 
            </ul>
          </div>
              </div>
  		  <?php }?>		
			<!-- hlavni obsah -->
          <div class="col-md-<?php if (!empty($_smarty_tpl->tpl_vars['admin_menu_L3']->value)){?>10<?php }else{ ?>12<?php }?>" id="ContentSection">
		     <?php if (!empty($_smarty_tpl->tpl_vars['admin_content']->value)){?><?php echo $_smarty_tpl->tpl_vars['admin_content']->value;?>
<?php }?>
		  </div>
          <!--  patička -->
          <div class="col-xs-12">
  	                        <footer>
  			   <p class="text-right">Powered by <a href="#" title="">HANA 2</a> CMS (v2.6)</p>
  			   
  	         </footer>
          </div>
		</div>
      </div>
    </body>
</html><?php }} ?>