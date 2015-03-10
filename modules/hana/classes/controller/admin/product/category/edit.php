<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Product_Category_Edit extends Controller_Hana_Edit
{
    protected $with_route=true;
    protected $max_category_level=3;
    protected $item_name_property=array("nazev"=>"s názvem");

    public function before() {
        $this->orm=new Model_Product_Category();
        parent::before();
        $this->subject_dir=$this->module_key."/".$this->submodule_key."/";
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
        $this->auto_edit_table->row("no_show_products")->type("checkbox")->label("Nezobrazovat seznam produktů")->set();
        
        //$this->auto_edit_table->row("nazev_jedno")->type("edit")->label("Název nahodný produkt (na homepage)")->condition("Položka musí mít minimálně 3 znaky.")->set();
        //$this->auto_edit_table->row("nazev_menu")->type("edit")->label("Název menu")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();

        $this->auto_edit_table->row("nazev_seo")->type("edit")->data_src(array("related_table_1"=>"route"))->label("Název SEO")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("nazev_full")->type("edit")->label("Nadpis")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
        $this->auto_edit_table->row("description")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("keywords")->type("edit")->label("Klíčová slova")->set();
        $this->auto_edit_table->row("parent_id")->type("selectbox")->label("Nadřazená kategorie")->item_settings(array("max_tree_level"=>$this->max_category_level))->data_src(array("column_name"=>"nazev","condition"=>array("zobrazit","=",1),"condition2"=>array("special_code","=",""),"orm_tree"=>true,"null_row"=>"---"))->set();
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->label("Zobrazit")->value(1)->set();
        //$this->auto_edit_table->row("zobrazit_carousel")->type("checkbox")->label("Zobrazit jako tab v carouselu (na homepage)")->value(1)->set();

        $this->auto_edit_table->row("main_image_src")->type("filebrowser")->label("Zdroj obrázku")->set();
        $this->auto_edit_table->row("main_image")->type("image")->item_settings(array("dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"jpg","delete_link"=>true))->label("Náhled obrázku")->set();
        $this->auto_edit_table->row("nav_image_src")->type("filebrowser")->label("Zdroj obrázku (pro navigaci)")->set();
        $this->auto_edit_table->row("nav_image")->type("image")->item_settings(array("dir"=>$this->subject_dir,"suffix"=>"nav-at","ext"=>"jpg","delete_link"=>true))->label("Náhled obrázku")->set();

        $this->auto_edit_table->row("price_from")->type("edit")->label("Cena od")->set();
        
        $this->auto_edit_table->row("uvodni_popis")->type("editor")->label("Úvodní text")->set();
        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();
        $this->auto_edit_table->row("class")->type("edit")->label("Třída prvku")->set();
    }

    protected function _form_action_main_prevalidate($data) {
        parent::_form_action_main_prevalidate($data);
        // specificka priprava dat, validace nedatabazovych zdroju (pripony obrazku apod.)
        if(!$data["title"] && $data["nazev"]){$data["title"]=$data["nazev"];}
        
        if(!$data["nazev_seo"] && $data["nazev"]){
            $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev"]); 
            $data["nazev_seo"]=$data["nazev_seo"];
        }elseif($data["nazev_seo"]){
            $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev_seo"]);
        }
//        if(!$data["nazev_full"] && $data["nazev"]){
//            $data["nazev_full"]=$data["nazev"]; 
//        }
//        if(!$data["nazev_menu"] && $data["nazev"]){
//            $data["nazev_menu"]=$data["nazev"]; 
//        }

        // nastaveni povinnych hodnot v pripojene tabulce "routes"
        // $data["action"]="category";
        
        $data["module_id"]=orm::factory("module")->where("kod","=","product")->find()->id;

        if($data["parent_id"])
        {
            $priorita = orm::factory("product_category")->select(array("product_categories.priorita","pcp"))->where("product_categories.id","=",$data["parent_id"])->find()->pcp;
            $data["priorita"]=$priorita+1;
            $data["module_action"]="category"; // specialni uvodka navazana na prvni uroven kategorii produktu
        }
        else
        {
            $data["priorita"]=0;
            $data["module_action"]="category";//"index";
        }
        
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

         // vlozim o obrazek
         if(isset($_FILES["nav_image_src"]) && $_FILES["nav_image_src"]["name"])
         {
             // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
             $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo");
             $this->module_service->insert_image("nav_image_src", $this->subject_dir, $image_settings, $this->orm->route->nazev_seo."-nav", true, "jpg", "photo_nav_src");
         }

    }

    /**
     * Akce na smazani obrazku !
     * @param <type> $data
     */
    protected function _form_action_main_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->subject_dir, false, false, false, "photo_src", "ext", false);
    }


 
}