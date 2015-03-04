<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Manufacturer_Edit extends Controller_Hana_Edit
{
    protected $with_route=true;
    protected $item_name_property=array("nazev"=>"s názvem");
    
    public function before() {
        $this->orm=new Model_Manufacturer();

        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
        $this->auto_edit_table->row("nazev_seo")->type("edit")->data_src(array("related_table_1"=>"route"))->label("Název SEO")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("description")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("keywords")->type("edit")->label("Klíčová slova")->set();
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->value(1)->label("Zobrazit")->set();
        $this->auto_edit_table->row("uvodni_popis")->type("editor")->label("Úvodní text")->set();
        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();
    }

    protected function _form_action_main_prevalidate($data) {
        parent::_form_action_main_prevalidate($data);
        // specificka priprava dat, validace nedatabazovych zdroju (pripony obrazku apod.)
        if(!$data["title"] && $data["nazev"]){$data["title"]=$data["nazev"];}
        
        if(!$data["nazev_seo"] && $data["nazev"]){
            $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev"]); $data["nazev_seo"]=$data["nazev_seo"];
        }elseif($data["nazev_seo"]){
            $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev_seo"]);
        }
        // defaultni akce v routes
        $data["module_action"]="manufacturer";
        $data["module_id"]=orm::factory("module")->where("kod","=","product")->find()->id;

        return $data;
    }

    protected function _form_action_main_validate($data) {
       // mozna vlastni implementace
       return parent::_form_action_main_validate($data);
    }

    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);
       // doplneni o ulozeni obrazku a dalsich dat
    }
}