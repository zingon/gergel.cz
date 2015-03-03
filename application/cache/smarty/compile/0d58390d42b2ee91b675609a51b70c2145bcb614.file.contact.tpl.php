<?php /* Smarty version Smarty-3.1.11, created on 2015-02-13 17:11:23
         compiled from "/var/www/orbcomm.cz/domains/www/application/views/emails/contact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:61126850654de222b97dab5-12206520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d58390d42b2ee91b675609a51b70c2145bcb614' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/application/views/emails/contact.tpl',
      1 => 1423822082,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61126850654de222b97dab5-12206520',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54de222b9e07c2_33046545',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54de222b9e07c2_33046545')) {function content_54de222b9e07c2_33046545($_smarty_tpl) {?>

<br /><br />
<table cellpadding="5" style="border: none; border-collapse: collapse;">
  <tr>
    <td><strong>Zpráva z kontaktního formuláře www stránek</strong></td>
    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['nazev_projektu'];?>
</td>
  </tr>
  <tr>
    <td><strong>Název stránky</strong></td>
    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['nazev_stranky'];?>
</td>
  </tr>
  <tr>
    <td><strong>URL</strong></td>
    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['url'];?>
</td>
  </tr>
  
  <tr>
    <td><strong>Jméno odesílatele</strong></td>
    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['jmeno'];?>
 <?php if ($_smarty_tpl->tpl_vars['data']->value['prijmeni']){?><?php echo $_smarty_tpl->tpl_vars['data']->value['prijmeni'];?>
<?php }?></td>
  </tr>
   <tr>
    <td><strong>E-mail odesílatele</strong></td>
    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
</td>
  </tr>
  
  <?php if (!empty($_smarty_tpl->tpl_vars['data']->value['telefon'])){?>
  <tr>
    <td><strong>Telefon</strong></td>
    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['telefon'];?>
</td>
  </tr>
  <?php }?>
 

  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Text dotazu:</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['data']->value['zprava'];?>
</td>
  </tr>
  <tr>
</table><?php }} ?>