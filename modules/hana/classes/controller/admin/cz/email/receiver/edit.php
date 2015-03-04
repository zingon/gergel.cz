<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace prijemcu emailu - edit.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2011 Pavel Herink
 */

class Controller_Admin_Cz_Email_Receiver_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    
    public function before() {
        $this->orm=new Model_Email_Receiver();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Jméno příjemce")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("email")->type("edit")->label("Email")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("email_type_id")->type("selectbox")->label("Kategorie")->item_settings(array("HTML"=>array("multiple"=>"multiple")))->data_src(array("related_table_1"=>"email_types","column_name"=>"nazev","orm_tree"=>false,"multiple"=>true))->set();
        
    }
    
    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);
       // ulozim k produktu reference na vybrane kategorie
       $this->module_service->bind_categories($data['email_type_id'],'email_type','email_types',false);
      
    }

    
}