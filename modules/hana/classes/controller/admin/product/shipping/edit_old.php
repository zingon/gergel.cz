<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace dopravy - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Shipping_Edit extends Controller_Hana_Edit
{

    public function before() {
        $this->orm=new Model_Shipping();
        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("popis")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("cena")->type("edit")->label("Cena v Kč")->set();
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->value(1)->label("Zobrazit")->set();
        $this->auto_edit_table->row("shipping_payment")->type("selectbox")->label("Zařazení k platbě")->item_settings(array("HTML"=>array("multiple"=>"multiple")))->data_src(array("related_table_1"=>"payments","column_name"=>"nazev","condition"=>array("zobrazit","=",1),"orm_tree"=>false,"multiple"=>true))->set();

    }


    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);
       // ulozim k produktu reference na vybrane kategorie
       $this->module_service->bind_categories($data['shipping_payment'],'payment',"",false);
    }


}