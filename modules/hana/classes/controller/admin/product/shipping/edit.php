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
    protected $with_route=false;

    public function before() {
        $this->orm=new Model_Shipping();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("popis")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("cena")->type("edit")->label("Jednotná cena v Kč s DPH")->condition("(při aktivovaných cenových hladinách představuje cenu po překročení poslední cenové hladiny))")->set();
        $this->auto_edit_table->row("cenove_hladiny")->type("checkbox")->label("Zapnout cenové hladiny")->condition("Při zaškrtnutí se doprava počítá podle cenových hladin.")->set();
        $this->auto_edit_table->row("pricelevel")->type("inneredit2param")->label("Cenové hladiny")->condition("<strong>Pozn: jakékoliv změny v cenových hladinách (i mazání) je nutné uložit. Přesáhne-li cena zboží nejvyšší uvedenou hladinu, bere se hodnota jednotné ceny.</strong>")->set();
        $this->auto_edit_table->row("icon")->type("edit")->label("Třída ikony")->set();
        $this->auto_edit_table->row("class")->type("edit")->label("Třída prvku")->set();
        
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->value(1)->label("Zobrazit")->set();
        $this->auto_edit_table->row("shipping_payment")->type("selectbox")->label("Zařazení k platbě")->item_settings(array("HTML"=>array("multiple"=>"multiple")))->data_src(array("related_table_1"=>"payments","column_name"=>"nazev","condition"=>array("zobrazit","=",1),"orm_tree"=>false,"multiple"=>true))->set();

    }

    protected function _form_action_main_prevalidate($data) {
        // specificka priprava dat, validace nedatabazovych zdroju (pripony obrazku apod.)
        return parent::_form_action_main_prevalidate($data);
    }

    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);
       // ulozim k produktu reference na vybrane kategorie
       $this->module_service->bind_categories($data['shipping_payment'],'payment',"",false);

       // ulolzeni hladin cen dopravy
       $rowdata=array();
       if(isset($_POST["level"]) && count($_POST["level"])>0)
       {
         foreach($_POST["level"] as $key=>$item)
         {
             $rowdata[$key]=array("level"=>$item,"value"=>$_POST["value"][$key]);
         }
       }
 
       Service_Hana_Shipping::insert_update_levels($this->orm->id, $rowdata);

       
    }


}