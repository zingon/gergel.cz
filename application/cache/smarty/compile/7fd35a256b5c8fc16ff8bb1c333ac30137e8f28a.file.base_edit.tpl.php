<?php /* Smarty version Smarty-3.1.11, created on 2015-02-17 15:04:15
         compiled from "/var/www/orbcomm.cz/domains/www/modules/hana/views/admin/edit/base_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155737032454e34a5f7b50e4-14853917%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fd35a256b5c8fc16ff8bb1c333ac30137e8f28a' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/modules/hana/views/admin/edit/base_edit.tpl',
      1 => 1423822329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155737032454e34a5f7b50e4-14853917',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form_url' => 0,
    'edtiable_languages' => 0,
    'back_to_item' => 0,
    'back_to_item_text' => 0,
    'back_link' => 0,
    'back_link_text' => 0,
    'clone_link' => 0,
    'media_path' => 0,
    'clone_link_text' => 0,
    'k' => 0,
    'sel_language_id' => 0,
    'disable_other_languages' => 0,
    'item' => 0,
    'copy_lang_link' => 0,
    'main_language' => 0,
    'message' => 0,
    'action_buttons' => 0,
    'script' => 0,
    'edit_table' => 0,
    'key' => 0,
    'row_parameters' => 0,
    'row_errors' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54e34a5f958bf7_57916291',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e34a5f958bf7_57916291')) {function content_54e34a5f958bf7_57916291($_smarty_tpl) {?>

<div class="row">  
    <form action="<?php echo $_smarty_tpl->tpl_vars['form_url']->value;?>
" method="post" enctype="multipart/form-data" name="EditForm" id="EditForm">
    <div class="col-md-<?php if (empty($_smarty_tpl->tpl_vars['edtiable_languages']->value)){?>12<?php }else{ ?>4<?php }?>">
      <?php if (isset($_smarty_tpl->tpl_vars['back_to_item']->value)&&$_smarty_tpl->tpl_vars['back_to_item']->value){?>
        <a class="btn btn-default" href="<?php echo $_smarty_tpl->tpl_vars['back_to_item']->value;?>
">
            <span class="glyphicon-chevron-left glyphicon"></span>
            <span><?php echo $_smarty_tpl->tpl_vars['back_to_item_text']->value;?>
</span>
        </a>
      <?php }?>
      <a class="btn btn-default" href="<?php echo $_smarty_tpl->tpl_vars['back_link']->value;?>
">
          <span class="glyphicon-chevron-left glyphicon"></span>
          <span><?php echo $_smarty_tpl->tpl_vars['back_link_text']->value;?>
</span>          
      </a>
      <?php if ($_smarty_tpl->tpl_vars['clone_link']->value){?>
        <a class="btn btn-default" href="<?php echo $_smarty_tpl->tpl_vars['clone_link']->value;?>
">
            <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/img/page_copy.png" alt="Otevře formulář pro vložení nové položky s předvyplněnými základními daty" />
            <span><?php echo $_smarty_tpl->tpl_vars['clone_link_text']->value;?>
</span></a>
      <?php }?>

    </div>   

    <?php if (!empty($_smarty_tpl->tpl_vars['edtiable_languages']->value)){?>        
    <div class="col-md-8 text-right">
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['edtiable_languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
            <a class="<?php if ($_smarty_tpl->tpl_vars['k']->value==$_smarty_tpl->tpl_vars['sel_language_id']->value){?>active<?php }elseif($_smarty_tpl->tpl_vars['disable_other_languages']->value){?>disabled<?php }?> btn btn-default" <?php if ($_smarty_tpl->tpl_vars['disable_other_languages']->value&&$_smarty_tpl->tpl_vars['k']->value!=$_smarty_tpl->tpl_vars['sel_language_id']->value){?>href="#" title="Uložte formulář nejprve v základní jazykové verzi"<?php }else{ ?>href="?admlang=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" title="jazyková verze: <?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</a>
        <?php } ?>
        <?php if ($_smarty_tpl->tpl_vars['sel_language_id']->value!=1&&$_smarty_tpl->tpl_vars['copy_lang_link']->value){?>
          <a href="?copylang=true" class="btn btn-info">kopírovat z <?php echo $_smarty_tpl->tpl_vars['main_language']->value;?>
</a></li>
        <?php }?>      
    </div>
    <?php }?>
</div>
     
    
    <?php if (!empty($_smarty_tpl->tpl_vars['message']->value)){?>  
<div class="row">
    <div class="col-md-12 space-5">
        <?php if ($_smarty_tpl->tpl_vars['message']->value=="error"){?> 
        <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Chyba:</strong> Při zpracování dat došlo k chybě, zkontrolujte prosím zadané údaje.
        </div>
        <?php }elseif($_smarty_tpl->tpl_vars['message']->value=="ok"){?>
        <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Změny byly uloženy.
        </div>
        <?php }elseif($_smarty_tpl->tpl_vars['message']->value=="deleted"){?>        
        <div class="alert alert-info fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Zvolené položky byly smazány.
        </div>
        <?php }elseif($_smarty_tpl->tpl_vars['message']->value=="highlight"){?>
        <div class="alert alert-warning fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Změna byla provedena.
        </div>
        <?php }?>
    </div>
</div>
		<?php }?>
<div class="row">
    <div class="col-md-12 margin-bottom-10 margin-top-10">
        <div class="btn-group hidden-xs">
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['action_buttons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                <button type="submit" id="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</button>
            <?php } ?>
        </div>
        <div class="btn-group-vertical visible-xs">
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['action_buttons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                <button type="submit" id="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</button>
            <?php } ?>
        </div>
    </div>
</div>
<div class="row"> 
    <div class="col-md-12">
    <?php if ($_smarty_tpl->tpl_vars['script']->value){?>
    <script type="text/javascript">
    <?php echo $_smarty_tpl->tpl_vars['script']->value;?>

    </script>
    <?php }?>
    <table summary="editační formulář" class="table table-striped" id="table-edit">

      <tbody>
      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['edit_table']->value['data_section']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?> 
        <tr <?php if (!empty($_smarty_tpl->tpl_vars['row_parameters']->value[$_smarty_tpl->tpl_vars['key']->value]['class'])){?> class="<?php echo $_smarty_tpl->tpl_vars['row_parameters']->value[$_smarty_tpl->tpl_vars['key']->value]['class'];?>
"<?php }?> class="form-group">
          <?php if (!empty($_smarty_tpl->tpl_vars['row_parameters']->value[$_smarty_tpl->tpl_vars['key']->value]['variant'])&&$_smarty_tpl->tpl_vars['row_parameters']->value[$_smarty_tpl->tpl_vars['key']->value]['variant']=="one_col"){?>
          <?php }else{ ?>            
            <td class="col1" style="width:30%">
                <?php if ($_smarty_tpl->tpl_vars['row_parameters']->value[$_smarty_tpl->tpl_vars['key']->value]['label']){?>
                    <label for="item_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" class="control-label"><?php echo $_smarty_tpl->tpl_vars['row_parameters']->value[$_smarty_tpl->tpl_vars['key']->value]['label'];?>
</label>
                <?php }?>
            </td>
          <?php }?>
          <td class="col2" id="item_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if (!empty($_smarty_tpl->tpl_vars['row_parameters']->value[$_smarty_tpl->tpl_vars['key']->value]['variant'])&&$_smarty_tpl->tpl_vars['row_parameters']->value[$_smarty_tpl->tpl_vars['key']->value]['variant']=="one_col"){?>colspan="2"<?php }?>>
            <?php if (!empty($_smarty_tpl->tpl_vars['row_errors']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
                <div class="has-error">
            <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['item']->value;?>

            <?php if (!empty($_smarty_tpl->tpl_vars['row_errors']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
                </div>
            <?php }?>
            <?php if (empty($_smarty_tpl->tpl_vars['row_errors']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
                <?php if (!empty($_smarty_tpl->tpl_vars['row_parameters']->value[$_smarty_tpl->tpl_vars['key']->value]['condition'])){?>
                    <p class="text-info"><?php echo $_smarty_tpl->tpl_vars['row_parameters']->value[$_smarty_tpl->tpl_vars['key']->value]['condition'];?>
</p>
                <?php }?>
              <?php }else{ ?>
              <p class="text-danger"><?php echo $_smarty_tpl->tpl_vars['row_errors']->value[$_smarty_tpl->tpl_vars['key']->value];?>
</span>
              <?php }?>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
        <div class="row">
            <div class="col-md-12 margin-bottom-10 margin-top-10">
                <div class="btn-group hidden-xs">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['action_buttons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                        <button type="submit" id="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</button>
                    <?php } ?>
                </div>
                <div class="btn-group-vertical visible-xs">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['action_buttons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                        <button type="submit" id="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    <input type="hidden" id="hana_edit_action" name="hana_form_action" value="main" /> 
              
  </form>
        <div id="JqueryForm" title="editace položky"><form id="JqueryFormIN" action="<?php echo $_smarty_tpl->tpl_vars['form_url']->value;?>
" method="post" enctype="multipart/form-data"></form></div>
    </div>
</div>


<?php }} ?>