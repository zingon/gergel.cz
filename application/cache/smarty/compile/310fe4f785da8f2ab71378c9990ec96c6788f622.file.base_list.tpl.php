<?php /* Smarty version Smarty-3.1.11, created on 2015-02-17 15:03:55
         compiled from "/var/www/orbcomm.cz/domains/www/modules/hana/views/admin/list/base_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:65269969454e34a4ba06159-13860098%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '310fe4f785da8f2ab71378c9990ec96c6788f622' => 
    array (
      0 => '/var/www/orbcomm.cz/domains/www/modules/hana/views/admin/list/base_list.tpl',
      1 => 1423822330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65269969454e34a4ba06159-13860098',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form_url' => 0,
    'new_link' => 0,
    'filter_button' => 0,
    'list_table' => 0,
    'message' => 0,
    'affected_rowid' => 0,
    'error_rows' => 0,
    'item' => 0,
    'total_cols' => 0,
    'total_rows' => 0,
    'key1' => 0,
    'row' => 0,
    'key' => 0,
    'count_records' => 0,
    'pagination' => 0,
    'items_per_pg' => 0,
    'items_per_pg_sel' => 0,
    'drag_reorder' => 0,
    'media_path' => 0,
    'delete_button' => 0,
    'save_button' => 0,
    'default_buttons' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_54e34a4bbfa3e9_34354994',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e34a4bbfa3e9_34354994')) {function content_54e34a4bbfa3e9_34354994($_smarty_tpl) {?>
<div class="row">
  <form action="<?php echo $_smarty_tpl->tpl_vars['form_url']->value;?>
" method="post">
  <!--  1. sekce hornich ovladacich tlacitek -->
  <div class="col-xs-12">
      <div class="row"> 
        <div class="col-xs-6">
        <?php if ($_smarty_tpl->tpl_vars['new_link']->value){?>
            <a class="btn btn-primary glyphicon-plus" href="<?php echo $_smarty_tpl->tpl_vars['new_link']->value;?>
" title="Nová položka"> Nová položka</a>
        <?php }?>
            <a class="btn btn-default glyphicon glyphicon-list-alt" href="?render=csv" title="Exportovat aktuální zobrazení seznamu do formátu CSV (UTF-8)"></a> 
            <a class="btn btn-default glyphicon glyphicon-print" href="?render=print" target="_blank" title="Zformátovat zvolený seznam pro tisk"></a>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['filter_button']->value){?>
            <div class="col-xs-6 text-right">
            <?php if (!$_smarty_tpl->tpl_vars['list_table']->value['filtering_row']['do_filter']){?>
                <div class="filteringSwitch">
                    <a class="btn btn-default" href="#"> filtrovat seznam</a>
                </div>
            <?php }else{ ?>
                <a class="btn btn-default" href="<?php echo $_smarty_tpl->tpl_vars['form_url']->value;?>
?destroy-filter=true">zrušit filtrování</a>
            <?php }?>
            </div>
        <?php }?>
    </div>
  </div>
</div>  

  
    <?php if (!empty($_smarty_tpl->tpl_vars['message']->value)){?>
<div class="row">
    <div class="col-xs-12 space-5">
        <?php if ($_smarty_tpl->tpl_vars['message']->value=="error"){?> 
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Chyba:</strong> Při zpracování dat došlo k chybě, zkontrolujte prosím zadané údaje.
        </div>
        <?php }elseif($_smarty_tpl->tpl_vars['message']->value=="ok"){?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Změny <?php if ($_smarty_tpl->tpl_vars['affected_rowid']->value){?>na položce ID: <?php echo $_smarty_tpl->tpl_vars['affected_rowid']->value;?>
 <?php }?>byly uloženy.<?php if ($_smarty_tpl->tpl_vars['affected_rowid']->value){?> (<a href="#to_rowid_<?php echo $_smarty_tpl->tpl_vars['affected_rowid']->value;?>
">přejít na řádek</a>)<?php }?>
        </div>
        <?php }elseif($_smarty_tpl->tpl_vars['message']->value=="deleted"){?>        
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Zvolené položky byly smazány.
        </div>
        <?php }elseif($_smarty_tpl->tpl_vars['message']->value=="highlight"){?>
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Na položce (položkách) <?php if (isset($_smarty_tpl->tpl_vars['error_rows']->value)){?>s ID: <span class="bold"><?php echo $_smarty_tpl->tpl_vars['error_rows']->value;?>
</span> <?php }?>byl zadán špatný formát dat, změny zde proto nemohly být uloženy.
        </div>
        <?php }?>
    </div>
</div>
		<?php }?>
<div class="row">
    <div class="col-xs-12 space-5" id="table-section">
      <div class="table-responsive">
        <table summary="seznam položek" id="ItemsList" class="table table-default table-hover">
        <thead>
        <!--  2. sekce vypisove tabulky -->
        <!--  nadpisy sloupcu -->
            <tr class="nodrop nodrag">
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list_table']->value['head_row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['iter']['total'] = $_smarty_tpl->tpl_vars['item']->total;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['iter']['last'] = $_smarty_tpl->tpl_vars['item']->last;
?>
                <th<?php if ($_smarty_tpl->tpl_vars['item']->value['html']){?> <?php echo $_smarty_tpl->tpl_vars['item']->value['html'];?>
<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['content'];?>
</th>
            <?php } ?>
            
            <?php $_smarty_tpl->tpl_vars['total_cols'] = new Smarty_variable($_smarty_tpl->getVariable('smarty')->value['foreach']['iter']['total'], null, 0);?>
            <?php $_smarty_tpl->tpl_vars['total_rows'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['list_table']->value['data_section']), null, 0);?>
            </tr>
        </thead>
        <tbody>
        <!--  filtrovaci radek -->
        <?php if ($_smarty_tpl->tpl_vars['filter_button']->value){?>
            <tr class="filteringRow filteringRowHide fr1 nodrop nodrag">
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list_table']->value['filtering_row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['iter']['total'] = $_smarty_tpl->tpl_vars['item']->total;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['iter']['last'] = $_smarty_tpl->tpl_vars['item']->last;
?>
                <?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['iter']['last']){?>
                    <td><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</td>
                <?php }?>
            <?php } ?>
            </tr>
            <tr class="filteringRow filteringRowHide fr2 nodrop nodrag">
                <td colspan="<?php echo $_smarty_tpl->tpl_vars['total_cols']->value;?>
">
                    <div class="right">
                        <button type="submit" class="btn btn-default" name="do-filter" value="filtrovat">filtrovat</button>
                        <button type="submit" class="btn btn-default" name="destroy-filter" value="zrušit filtrování">zrušit filtrování</button>
                    </div>
                </td>
            </tr>
    <?php }?> 
    
    <!--  telo tabulky -->
      
      <?php if ($_smarty_tpl->tpl_vars['total_rows']->value>0){?>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_smarty_tpl->tpl_vars['key1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list_table']->value['data_section']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
 $_smarty_tpl->tpl_vars['key1']->value = $_smarty_tpl->tpl_vars['row']->key;
?>
        <tr id="rowid_<?php echo $_smarty_tpl->tpl_vars['key1']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['affected_rowid']->value==$_smarty_tpl->tpl_vars['key1']->value){?> class="affected"<?php }?>>
          <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['row']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['item']->index++;
 $_smarty_tpl->tpl_vars['item']->first = $_smarty_tpl->tpl_vars['item']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['iter2']['first'] = $_smarty_tpl->tpl_vars['item']->first;
?>
          
          <td<?php if ($_smarty_tpl->tpl_vars['list_table']->value['head_row'][$_smarty_tpl->tpl_vars['key']->value]['html']){?> <?php echo $_smarty_tpl->tpl_vars['list_table']->value['head_row'][$_smarty_tpl->tpl_vars['key']->value]['html'];?>
<?php }?>><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['iter2']['first']){?><a name="to_rowid_<?php echo $_smarty_tpl->tpl_vars['key1']->value;?>
" id="to_rowid_<?php echo $_smarty_tpl->tpl_vars['key1']->value;?>
"></a><?php }?><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</td>
          <?php } ?>
        </tr>
        <?php } ?>
       <?php }else{ ?>
          <tr><td colspan="<?php echo $_smarty_tpl->tpl_vars['total_cols']->value;?>
"><div class="txtCenter">
          <?php if (!$_smarty_tpl->tpl_vars['list_table']->value['filtering_row']['do_filter']){?>
          -- bez záznamu --
          <?php }else{ ?>
          -- pro zvolené nastavení filtru nebyl nalezen žádný záznam --
          <?php }?>
          </div></td></tr>
       <?php }?>
    <!--  3. sekce - sumarizacni radek - nepovinne --> 
      <?php if (!empty($_smarty_tpl->tpl_vars['list_table']->value['summary_row'])){?>
      <tr>
      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['list_table']->value['head_row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['item']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['iter']['total'] = $_smarty_tpl->tpl_vars['item']->total;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
 $_smarty_tpl->tpl_vars['item']->iteration++;
 $_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['iter']['last'] = $_smarty_tpl->tpl_vars['item']->last;
?>
        <td <?php if ($_smarty_tpl->tpl_vars['list_table']->value['head_row'][$_smarty_tpl->tpl_vars['key']->value]['html']){?> <?php echo $_smarty_tpl->tpl_vars['list_table']->value['head_row'][$_smarty_tpl->tpl_vars['key']->value]['html'];?>
<?php }?>><?php if (isset($_smarty_tpl->tpl_vars['list_table']->value['summary_row'][$_smarty_tpl->tpl_vars['key']->value])){?><?php echo $_smarty_tpl->tpl_vars['list_table']->value['summary_row'][$_smarty_tpl->tpl_vars['key']->value];?>
<?php }?></td>
      <?php } ?>
      </tr>  
      <?php }?>
    </tbody>
    <tfoot>
        <tr class="nodrop nodrag">
            <td colspan="15">                
                <?php echo $_smarty_tpl->tpl_vars['count_records']->value;?>

            </td>
        </tr>
    </tfoot>
    </table>
   </div>
  </div>
</div>
<div class="row"> 
    <!--  4. sekce listovani -->
    <div class="col-sm-7">
        <?php echo $_smarty_tpl->tpl_vars['pagination']->value;?>

    </div>
    <div class="col-sm-5 text-right strankovani">
        <span class="hidden-xs">Stránkování po:</span>
        <div class="btn-group">
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['items_per_pg']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                <a class="btn btn-default"  <?php if ($_smarty_tpl->tpl_vars['key']->value==$_smarty_tpl->tpl_vars['items_per_pg_sel']->value){?>disabled<?php }?> href="<?php echo $_smarty_tpl->tpl_vars['form_url']->value;?>
?it_per_pg=<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" title="Stránkování po <?php echo $_smarty_tpl->tpl_vars['item']->value;?>
 řádcíh" class="ajaxelement"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</a>
            <?php } ?>
        </div>
    </div>
</div>

  <!--  5. sekce spodnich ovladacich tlacitek -->
<div class="row">
    <div class="col-xs-12">
         <div class="panel panel-default">
             <div class="panel-body">
                 <div class="row">                    
                    <?php if ($_smarty_tpl->tpl_vars['drag_reorder']->value){?>
                    <div class="col-sm-6 hidden-xs">
                        <img src="<?php echo $_smarty_tpl->tpl_vars['media_path']->value;?>
admin/img/arrow_up_down.png" alt="Řazení tažením myší je aktivní" width="16" height="16" />
                            Řazení položek tažením myší je <strong>aktivováno</strong>.
                    </div>
                    <?php }?>
                    
                    <div class="col-sm-<?php if ($_smarty_tpl->tpl_vars['drag_reorder']->value){?>6<?php }else{ ?>12<?php }?> text-right">
                             <label for="sellAll"> vybrat vše</label> 
                             <input type="checkbox" name="sellAll" type="form-control" class="sellAll" id="sellAll" />
                        <?php if ($_smarty_tpl->tpl_vars['delete_button']->value){?>
                        <button type="submit" class="btn btn-warning" name="hana_form_action[delete]" value="smazat označené"  onclick="javascript: return confirm('Opravdu smazat vybrané položky?'); ">smazat označené</button><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['save_button']->value){?>
                        <button type="submit" class="btn btn-primary" name="hana_form_action[save]" value="<?php echo $_smarty_tpl->tpl_vars['save_button']->value;?>
"  onclick="javascript: return confirm('Opravdu uložit provedené změny?'); "><?php echo $_smarty_tpl->tpl_vars['save_button']->value;?>
</button><?php }?>
                        <?php if (!empty($_smarty_tpl->tpl_vars['default_buttons']->value)){?>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['default_buttons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <button type="<?php echo $_smarty_tpl->tpl_vars['item']->value['type'];?>
" class="btn btn-default" id="button_<?php echo $_smarty_tpl->tpl_vars['item']->value['action'];?>
" name="hana_form_action[<?php echo $_smarty_tpl->tpl_vars['item']->value['action'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['onclick']){?>onclick="javascript: return confirm('<?php echo $_smarty_tpl->tpl_vars['item']->value['onclick'];?>
');" <?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['nazev'];?>
</button>
                        <?php } ?>
                        <?php }?>
  
                    </div>    
                    </form>
                 </div>
             </div>
         </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
  <?php if ($_smarty_tpl->tpl_vars['list_table']->value['filtering_row']['do_filter']){?>
  $(".filteringRow").removeClass("filteringRowHide");
  <?php }?>
   
 
  <?php if ($_smarty_tpl->tpl_vars['drag_reorder']->value){?>
  $("#table-section table").tableDnD({
    onDrop: function(table, row) {
      
                   xurl = $(this).attr("href"); 
                   $('#ContentSection tbody').showLoading(); 
                   $(this).attr("href","javascript: //ajax_request_process;"); 
                   $.ajax({
                     type: "GET",
                     url: "?hana_form_action=drag_change_order&reorder_item="+row.id+"&" + $.tableDnD.serialize(),
                     success: function(msg){
                     //alert( "Obdržená data: " + msg );
                     $('#ContentSection tbody').hideLoading(); 
                     $('#ContentSection').html(msg);
                     //$(this).attr("href",xurl);
                     },
                     error: function(XMLHttpRequest, textStatus, errorThrown){
                        $('#ContentSection tbody').hideLoading(); 
                        alert("Při zpracování dat došlo k chybě");
                        //alert("Při zpracování dat došlo k chybě: " + XMLHttpRequest + ", textStatus: " + textStatus+ ", errorThrown: " + errorThrown);
                     }
                 
      });
    }
   
  });
  <?php }?>
  
});     
</script>


<?php }} ?>