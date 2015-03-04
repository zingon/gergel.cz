<?php /* Smarty version Smarty-3.1.11, created on 2015-02-01 21:02:23
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/navigation/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6161450954a0ade6706de0-15598358%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f3daec30c1d93b374a4e824e46620f09f799a90' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/navigation/main.tpl',
      1 => 1422820934,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6161450954a0ade6706de0-15598358',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54a0ade675f044_72441954',
  'variables' => 
  array (
    'links' => 0,
    'key' => 0,
    'sel_links' => 0,
    'link' => 0,
    'url_base' => 0,
    'key_c' => 0,
    'child' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a0ade675f044_72441954')) {function content_54a0ade675f044_72441954($_smarty_tpl) {?><div id="main-nav">
    <div class="row">
        <div class="small-12 column">
            <nav class="top-bar" data-topbar role="navigation" id="main">
                <ul class="title-area">
                    <li class="name hidden-for-medium-up">
                    </li>
                    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
                </ul>

                <section class="top-bar-section display-table" id="full">
                    <ul class="display-row">
                        <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['links']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['link']->key;
?>
                            <li class="<?php if (array_key_exists($_smarty_tpl->tpl_vars['key']->value,$_smarty_tpl->tpl_vars['sel_links']->value)){?>active<?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['link']->value['children'])){?>has-dropdown <?php if ($_smarty_tpl->tpl_vars['link']->value['module_id']==6){?>catalog<?php }?><?php }?> display-cell">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['link']->value['nazev'];?>
</a>
                                <?php if (!empty($_smarty_tpl->tpl_vars['link']->value['children'])){?>
                                    <ul class="dropdown <?php if ($_smarty_tpl->tpl_vars['link']->value['module_id']==6){?>medium-block-grid-4 catalog<?php }?>">
                                        <?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['child']->_loop = false;
 $_smarty_tpl->tpl_vars['key_c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['link']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
$_smarty_tpl->tpl_vars['child']->_loop = true;
 $_smarty_tpl->tpl_vars['key_c']->value = $_smarty_tpl->tpl_vars['child']->key;
?>
                                            <li class="<?php if (array_key_exists($_smarty_tpl->tpl_vars['key_c']->value,$_smarty_tpl->tpl_vars['sel_links']->value)){?>active<?php }?>">
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['url_base']->value;?>
<?php echo $_smarty_tpl->tpl_vars['key_c']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['child']->value['nazev'];?>
</a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php }?>
                            </li>
                        <?php } ?>
                    </ul>
                </section>
            </nav>
        </div>
    </div>
</div>
<?php }} ?>