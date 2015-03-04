<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace plateb - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Payment_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    
    public function before() {
        $this->orm=new Model_Payment();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("popis")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("typ")->type("selectbox")->label("Typ hodnoty")->data_src(array("column_name"=>"typ","data_array"=>array(1=>"hodnota v Kč",2=>"hodnota %")))->set();
        $this->auto_edit_table->row("cena")->type("edit")->label("Hodnota (v Kč, nebo %)")->set();
        $this->auto_edit_table->row("predem")->type("checkbox")->value(1)->label("Zaslat zálohovou fakturu (platba předem)")->set();
        $this->auto_edit_table->row("payu")->type("checkbox")->label("Typ platby PayU")->condition("Zobrazí formulář platby PayU")->set();
        $this->auto_edit_table->row("icon")->type("edit")->label("Třída ikony")->set();
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->value(1)->label("Zobrazit")->set();
        $this->auto_edit_table->row("shipping_payment")->type("selectbox")->label("Zařazení k dopravě")->item_settings(array("HTML"=>array("multiple"=>"multiple")))->data_src(array("related_table_1"=>"shippings","column_name"=>"nazev","condition"=>array("zobrazit","=",1),"orm_tree"=>false,"multiple"=>true))->set();

    }

    protected function _form_action_main_prevalidate($data) {
        // specificka priprava dat, validace nedatabazovych zdroju (pripony obrazku apod.)
        return parent::_form_action_main_prevalidate($data);
    }

    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);
       // ulozim k produktu reference na vybrane kategorie
       $this->module_service->bind_categories($data['shipping_payment'],'shipping',"",false);
    }

    
}