<?php /* Smarty version Smarty-3.1.11, created on 2015-01-30 14:19:56
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/modules/hana/views/admin/filemanager/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166364440954cb84fce3ab91-54152257%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a423b30160d757cb49ffd7fa8ed48d7f15770a94' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/modules/hana/views/admin/filemanager/index.tpl',
      1 => 1422623995,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166364440954cb84fce3ab91-54152257',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'media_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54cb84fcec5ab9_82342416',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54cb84fcec5ab9_82342416')) {function content_54cb84fcec5ab9_82342416($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>File Manager</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/styles/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/scripts/jquery.filetree/jqueryFileTree.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/scripts/jquery.contextmenu/jquery.contextMenu-1.01.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/styles/filemanager.css" />
    <!--[if IE 9]>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/styles/ie9.css" />
    <![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/styles/ie8.css" />
    <![endif]-->
</head>
<body>
<div>
    <form id="uploader" method="post">
        <button id="home" name="home" type="button" value="Home">&nbsp;</button>
        <h1></h1>
        <div id="uploadresponse"></div>
        <input id="mode" name="mode" type="hidden" value="add" />
        <input id="currentpath" name="currentpath" type="hidden" />
        <div id="file-input-container">
            <div id="alt-fileinput">
                <input id="filepath" name="filepath" type="text" /><button id="browse" name="browse" type="button" value="Browse"></button>
            </div>
            <input	id="newfile" name="newfile" type="file" />
        </div>
        <button id="upload" name="upload" type="submit" value="Upload"></button>
        <button id="newfolder" name="newfolder" type="button" value="New Folder"></button>
        <button id="grid" class="ON" type="button">&nbsp;</button>
        <button id="list" type="button">&nbsp;</button>
    </form>
    <div id="splitter">
        <div id="filetree"></div>
        <div id="fileinfo">
            <h1></h1>
        </div>
    </div>
    <form name="search" id="search" method="get">
        <div>
            <input type="text" value="" name="q" id="q" />
            <a id="reset" href="#" class="q-reset"></a>
            <span class="q-inactive"></span>
        </div>
    </form>

    <ul id="itemOptions" class="contextMenu">
        <li class="select"><a href="#select"></a></li>
        <li class="download"><a href="#download"></a></li>
        <li class="rename"><a href="#rename"></a></li>
        <li class="move"><a href="#move"></a></li>
        <li class="replace"><a href="#replace"></a></li>
        <li class="delete separator"><a href="#delete"></a></li>
    </ul>

    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/scripts/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/scripts/jquery.form-3.24.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/scripts/jquery.splitter/jquery.splitter-1.5.1.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/scripts/jquery.filetree/jqueryFileTree.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/scripts/jquery.contextmenu/jquery.contextMenu-1.01.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/scripts/jquery.impromptu-3.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/scripts/jquery.tablesorter-2.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/js/filemanager/scripts/filemanager.js"></script>
</div>
</body>
</html><?php }} ?>