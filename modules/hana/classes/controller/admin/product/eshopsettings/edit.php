<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace nastaveni.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Eshopsettings_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    protected $back_link_url;
    protected $back_link_text="Zpět";
    protected $cloneable=false;
    protected $item_name_property="editace nastavení e-shopu";

    public function before() {
        $this->orm=new Model_Product_Setting();

        $this->back_link_url = url::base()."admin/product/item/list";
        $this->send_link_url = url::base()."admin/product/eshopsettings/edit/1/1";

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("L1")->variant("one_col")->value("Fakturační údaje e-shopu")->type("label")->set();
        $this->auto_edit_table->row("billing_data_nazev")->type("edit")->label("Název")->set();
        $this->auto_edit_table->row("billing_data_email")->type("edit")->label("E-mail")->set();
        $this->auto_edit_table->row("billing_data_telefon")->type("edit")->label("Telefon")->set();
        $this->auto_edit_table->row("billing_data_fax")->type("edit")->label("Fax")->set();
        $this->auto_edit_table->row("billing_data_ulice")->type("edit")->label("Ulice")->set();
        $this->auto_edit_table->row("billing_data_mesto")->type("edit")->label("Město")->set();
        $this->auto_edit_table->row("billing_data_psc")->type("edit")->label("PSČ")->set();
        $this->auto_edit_table->row("billing_data_ic")->type("edit")->label("IČ")->set();
        $this->auto_edit_table->row("billing_data_dic")->type("edit")->label("DIČ")->set();
        $this->auto_edit_table->row("L2")->variant("one_col")->value("Bankovní spojení")->type("label")->set();  
        $this->auto_edit_table->row("billing_data_banka")->type("edit")->label("Banka")->set();
        $this->auto_edit_table->row("billing_data_iban")->type("edit")->label("IBAN")->set();
        $this->auto_edit_table->row("billing_data_cislo_uctu")->type("edit")->label("Číslo účtu")->set();
        $this->auto_edit_table->row("billing_data_konst_s")->type("edit")->label("Konstantní symbol")->set();
        $this->auto_edit_table->row("billing_data_spec_s")->type("edit")->label("Specifický symbol")->set();
        $this->auto_edit_table->row("billing_data_swift")->type("edit")->label("SWIFT")->set();
        $this->auto_edit_table->row("L21")->variant("one_col")->value("Zálohová faktura")->type("label")->set();
        $this->auto_edit_table->row("billing_data_due_date")->type("edit")->label("Splatnost (dní)")->set();
        
        $this->auto_edit_table->row("L3")->variant("one_col")->value("Dárkový program")->type("label")->set();
        $this->auto_edit_table->row("present_enabled")->type("checkbox")->label("Zapnout funkci dárku")->set();
        /*$this->auto_edit_table->row("present_price_threshold")->type("edit")->label("Cena nákupu v Kč s DPH pro aktivaci dárku")->set();*/
        
        $this->auto_edit_table->row("L4")->variant("one_col")->value("Globální slevy")->type("label")->set();
        $this->auto_edit_table->row("shipping_free_threshold")->type("edit")->label("Doprava zdarma od:")->set();
        
        $this->auto_edit_table->row("first_purchase_discount")->type("edit")->label("Sleva na první nákup:")->set();
        

    }

}