<?php /* Smarty version Smarty-3.1.11, created on 2015-01-11 23:06:37
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/navigation/secondary.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22717068454b2f3edbf02a5-31088393%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9bf0815988564249b47214245ff3e45a69e11d15' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/navigation/secondary.tpl',
      1 => 1421013767,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22717068454b2f3edbf02a5-31088393',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'prev' => 0,
    'links' => 0,
    'link' => 0,
    'sel_links' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54b2f3edc3c400_35472315',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b2f3edc3c400_35472315')) {function content_54b2f3edc3c400_35472315($_smarty_tpl) {?><div id="nav-sub">
    <ul class="side-nav hidden-for-small-down">
        <li class="header">
            <a href="<?php echo $_smarty_tpl->tpl_vars['prev']->value['nazev_seo'];?>
">
                <?php echo $_smarty_tpl->tpl_vars['prev']->value['nazev'];?>

            </a>
        </li>
        <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['links']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['link']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['link']['iteration']++;
?>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['link']['iteration']>1){?>
                <li class="hr"><hr></li>
            <?php }?>
            <li class="<?php if (array_key_exists($_smarty_tpl->tpl_vars['link']->value['nazev_seo'],$_smarty_tpl->tpl_vars['sel_links']->value)){?>active<?php }?>">
                <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value['nazev_seo'];?>
">
                    <?php echo $_smarty_tpl->tpl_vars['link']->value['nazev'];?>

                </a>
            </li>
        <?php } ?>
    </ul>
    <nav class="top-bar show-for-small-down" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><a href="#"><?php echo $_smarty_tpl->tpl_vars['prev']->value['nazev'];?>
</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>

        <section class="top-bar-section">
            <ul class="left">
                <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['links']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value){
$_smarty_tpl->tpl_vars['link']->_loop = true;
?>
                    <li class="<?php if (array_key_exists($_smarty_tpl->tpl_vars['link']->value['nazev_seo'],$_smarty_tpl->tpl_vars['sel_links']->value)){?>active<?php }?>">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value['nazev_seo'];?>
">
                            <?php echo $_smarty_tpl->tpl_vars['link']->value['nazev'];?>

                        </a>
                    </li>
                <?php } ?>
            </ul>
        </section>
    </nav>

</div><?php }} ?>