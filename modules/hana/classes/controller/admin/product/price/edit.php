<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace cenovych skupin - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Price_Edit extends Controller_Hana_Edit
{
    
    public function before() {
        $this->orm=new Model_Price_Category();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("kod")->type("edit")->label("Kód")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("price_type_id")->type("selectbox")->label("Typ cenové skupiny")->data_src(array("related_table_1"=>"price_type","column_name"=>"kod"))->set();
        $this->auto_edit_table->row("popis")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("hodnota")->type("edit")->label("Hodnota v % z výchozí (pouze u cen daných procentem)")->set();
        if($this->orm->kod != "D0")
        {
            $this->auto_edit_table->row("zaradit_zakaznika_od")->type("edit")->label("Zařadit zákazníka od")->condition("Zákazník bude zařazen od hodnoty nákupu Kč (hodnota zboží s DPH), hodnota 0 = vypnuto")->set();
        }
        
    }
    
}