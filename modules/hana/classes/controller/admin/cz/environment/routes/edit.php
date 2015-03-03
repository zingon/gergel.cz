<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace modulovych registru - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Cz_Environment_Routes_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    
    public function before() {
        $this->orm=new Model_Route();
        parent::before();
        
    }

    protected function _column_definitions()
    {

        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        
        $this->auto_edit_table->row("created_date")->label("Datum vytvoření")->set();
        $this->auto_edit_table->row("updated_date")->label("Datum aktualizace")->set();
        $this->auto_edit_table->row("deleted_date")->label("Datum smazání")->set();
        
        $this->auto_edit_table->row("nazev_seo")->type("edit")->label("Název seo")->condition("Položka musí být vyplněna.")->set();  
        $this->auto_edit_table->row("module_id")->type("selectbox")->label("Kontroler (modul)")->data_src(array("related_table_1"=>"module","column_name"=>"nazev","orm_tree"=>false))->set();
        
        $this->auto_edit_table->row("module_action")->default_value("index")->type("edit")->label("Akce kontroleru")->condition("Položka musí být vyplněna.")->set();
        $this->auto_edit_table->row("param_id1")->type("edit")->label("Zvláštní parametr")->set();
        
        $this->auto_edit_table->row("language_id")->type("edit")->default_value(1)->label("ID jazykové verze")->set();
        $this->auto_edit_table->row("baselang_route_id")->type("edit")->label("ID routy v základním jazyce")->set();
        
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek (title)")->set();
        $this->auto_edit_table->row("description")->type("edit")->label("Popis (meta name=description)")->set();
        $this->auto_edit_table->row("keywords")->type("edit")->label("Klíčová slova (meta name=keywords)")->set();
        
        $this->auto_edit_table->row("zobrazit")->default_value(1)->type("checkbox")->label("Zobrazit")->set();
        
        $this->auto_edit_table->row("read_only")->default_value(1)->type("checkbox")->label("Readonly")->set();
        $this->auto_edit_table->row("internal")->type("checkbox")->label("Interní")->condition("Výchozí systémová routa - distribuovaná spolu s určitým modulem při instalaci systému.")->set();
        $this->auto_edit_table->row("searcheable")->default_value(1)->type("checkbox")->label("Vyhledatelná")->set();
        $this->auto_edit_table->row("deleted")->type("checkbox")->label("Smazaná")->set();
        
        //$this->auto_edit_table->row("nazev_seo_old")->type("edit")->label("Původní název seo")->set();
        
  
    }

}