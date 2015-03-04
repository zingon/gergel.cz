<?php /* Smarty version Smarty-3.1.11, created on 2015-01-11 23:03:32
         compiled from "/var/www/dgsbeta.cz/domains/orbcomm/application/views/message.tpl" */ ?>
<?php /*%%SmartyHeaderCode:168849913654b2f3345e27c4-36708298%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13b4fcce40f7867613982aacd0bd60a04caae708' => 
    array (
      0 => '/var/www/dgsbeta.cz/domains/orbcomm/application/views/message.tpl',
      1 => 1418594507,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '168849913654b2f3345e27c4-36708298',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'messages' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54b2f3345fb064_86616381',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b2f3345fb064_86616381')) {function content_54b2f3345fb064_86616381($_smarty_tpl) {?>
<?php if (!empty($_smarty_tpl->tpl_vars['messages']->value)){?>
    <div id="message" class="reveal-modal small" data-reveal>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['messages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
            <?php echo $_smarty_tpl->tpl_vars['item']->value;?>
<br />
        <?php } ?>
        <a class="close-reveal-modal">&#215;</a>
    </div>




<script>
$(document).ready(function(){
    $('#message').foundation('reveal', 'open');
});
</script>


<?php }?>
<?php }} ?>