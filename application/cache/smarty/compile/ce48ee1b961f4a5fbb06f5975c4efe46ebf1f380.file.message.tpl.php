<?php /* Smarty version Smarty-3.1.11, created on 2015-02-13 13:47:19
         compiled from "/var/www/orbcomm.cz/domains/www/application/views/message.tpl" */ ?>
<?php /*%%SmartyHeaderCode:182573932354ddf257c0d0c8-63908680%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce48ee1b961f4a5fbb06f5975c4efe46ebf1f380' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/application/views/message.tpl',
      1 => 1423822081,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182573932354ddf257c0d0c8-63908680',
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
  'unifunc' => 'content_54ddf257c23a64_95806978',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ddf257c23a64_95806978')) {function content_54ddf257c23a64_95806978($_smarty_tpl) {?>
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