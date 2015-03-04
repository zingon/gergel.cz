<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace stranek - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Environment_Samodules_Edit extends Controller_Hana_Edit
{
    protected $with_route=false;
    protected $max_category_level=3;
    
    public function before() {
        $this->orm=new Model_Admin_Structure();
        parent::before();
        
    }

    protected function _column_definitions()
    {

        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí být vyplněna")->set();
        $this->auto_edit_table->row("module_code")->type("edit")->label("Kód modulu")->condition("Položka musí být vyplněna")->set();
        $this->auto_edit_table->row("submodule_code")->type("edit")->label("Kód submodulu")->condition("Položka musí být vyplněna")->set();
        $this->auto_edit_table->row("module_controller")->type("edit")->label("Název kontroleru")->default_value("list")->condition("Položka musí být vyplněna")->set();

        $this->auto_edit_table->row("nadpis")->type("edit")->label("Nadpis")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("description")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("parent_id")->type("selectbox")->label("Nadřazená kategorie")->item_settings(array("max_tree_level"=>$this->max_category_level))->data_src(array("column_name"=>"nazev","condition"=>array("zobrazit","=",1),"orm_tree"=>true,"null_row"=>"---","language"=>false))->set();
        $this->auto_edit_table->row("admin_menu_section_id")->type("selectbox")->label("Umístění položky")->data_src(array("data_array"=>array(1=>"1 - horní záložky",2=>"2 - lišta pod horními záložkami",3=>"3 - levá sekce")))->set();
        
        $this->auto_edit_table->row("global_access_level")->type("selectbox")->label("Přístupová práva")->data_src(array("data_array"=>array(0=>"0 - defaultní",1=>"1 - základní",2=>"2 - hlavní admin",3=>"3 - superadmin")))->set();

        $this->auto_edit_table->row("zobrazit")->type("checkbox")->default_value(1)->label("Zobrazit")->set();
        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();
        

    }

    protected function _form_action_main_prevalidate($data) {
        parent::_form_action_main_prevalidate($data);
        // specificka priprava dat, validace nedatabazovych zdroju (pripony obrazku apod.)
        if(!$data["title"] && $data["nazev"]){$data["title"]=$data["nazev"];}
        if(!$data["nadpis"] && $data["nazev"]){$data["nadpis"]=$data["nazev"];}
        
        // mechanismus na generovani nazvu seo - nejprve testujeme, zda byl ve formulari nastaven (read-only), pokud ne, odstranime ho z dat (nebude vyzadovana validace)
        if(isset($_POST["nazev_seo"]))
        {
            if(!$data["nazev_seo"] && $data["nazev"]){
                $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev"]); $data["nazev_seo"]=$data["nazev_seo"];
            }elseif($data["nazev_seo"]){
                $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev_seo"]);
            }
        }
        else
        {
            unset($data["nazev_seo"]);
        }

        // defaultni akce v routes
        $data["action"]="index";
        return $data;
    }


    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);

       // vlozim o obrazek
       if(isset($_FILES["main_image_src"]) && $_FILES["main_image_src"]["name"])
       {
           // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
           $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo");
           $this->module_service->insert_image("main_image_src", $this->subject_dir, $image_settings, $this->orm->route->nazev_seo);
       }

    }

    /**
     * Akce na smazani obrazku !
     * @param <type> $data
     */
    protected function _form_action_main_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->subject_dir);
    }

}