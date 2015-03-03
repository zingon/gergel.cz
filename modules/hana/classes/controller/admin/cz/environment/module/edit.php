<?php defined('SYSPATH') or die('No direct script access.');


class Controller_Admin_Cz_Environment_Module_Edit extends Controller_Hana_Edit
{

    public function before() {
        $this->orm=new Model_Module();
        
        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("kod")->type("edit")->label("Kód")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->set();
        $this->auto_edit_table->row("available")->type("checkbox")->value(0)->label("Povolit")->set();
        $this->auto_edit_table->row("service_name")->type("edit")->value(0)->label("Název hlavní servisní třídy")->condition("Nebude-li uveden, bere se stejný jako kód.")->set();
        $this->auto_edit_table->row("verze")->type("edit")->label("Verze")->set();
        $this->auto_edit_table->row("datum")->type("datepicker")->label("Datum")->set();
        $this->auto_edit_table->row("autor")->type("edit")->label("Autor")->set();
        $this->auto_edit_table->row("url")->type("edit")->label("Url")->set();
        $this->auto_edit_table->row("email")->type("edit")->label("Email")->set();
        $this->auto_edit_table->row("popis")->type("edit")->label("Popis")->set();

        $this->auto_edit_table->row("poznamka")->type("editor")->label("Poznamka")->set();
        $this->auto_edit_table->row("admin_zobrazit")->type("checkbox")->value(0)->label("Zobrazit v administraci")->set();
        
    }
    
}