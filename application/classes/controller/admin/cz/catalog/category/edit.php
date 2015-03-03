<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace produktu - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2013 Pavel Herink
 */

class Controller_Admin_Cz_Catalog_Category_Edit extends Controller_Hana_Edit
{
    protected $with_route=true;
    protected $max_category_level=3;
    protected $item_name_property=array("nazev"=>"s názvem");

    public function before() {
        $this->orm=new Model_Catalog_Category();
        parent::before();
        $this->subject_dir=$this->module_key."/".$this->submodule_key."/";
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
        $this->auto_edit_table->row("nazev_seo")->type("edit")->data_src(array("related_table_1"=>"route"))->label("Název SEO")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("description")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("keywords")->type("edit")->label("Klíčová slova")->set();

        $this->auto_edit_table->row("zobrazit")->type("checkbox")->default_value(1)->label("Zobrazit")->set();
        $this->auto_edit_table->row("homepage")->type("checkbox")->default_value(1)->label("Zobrazit na úvodní stránce")->set();
        $this->auto_edit_table->row("contact_form")->type("checkbox")->default_value(1)->label("Vložit kontaktní formulář")->set();

        $this->auto_edit_table->row("main_image_src")->type("filebrowser")->label("Zdroj obrázku (bílý)")->set();
        $this->auto_edit_table->row("main_image")->type("image")->item_settings(array("dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"png","delete_link"=>true))->label("Náhled obrázku")->set();

        $this->auto_edit_table->row("sec_image_src")->type("filebrowser")->label("Zdroj obrázku (červený)")->set();
        $this->auto_edit_table->row("sec_image")->type("image")->item_settings(array("db_col_name"=>"sec_src","dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"png","delete_link"=>true))->label("Náhled obrázku")->set();
        $this->auto_edit_table->row("uvodni_popis")->type("textarea")->label("Úvodní text (stručný popis)")->set();
        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();

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
        
        $data["module_id"]=orm::factory("module")->where("kod","=","catalog")->find()->id;

        if(!empty($data["parent_id"]))
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


        $data["home_image_src"] = $this->orm->home_image_src;

        return $data;
    }
     protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);


         // vlozim o obrazek
         if(isset($_FILES["main_image_src"]) && $_FILES["main_image_src"]["name"])
         {
             // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
             $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo");
             $this->module_service->insert_image("main_image_src", $this->subject_dir, $image_settings, $this->orm->route->nazev_seo.'_white', true, 'png');
         }
         if(isset($_FILES["sec_image_src"]) && $_FILES["sec_image_src"]["name"])
         {
             // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
             $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo");
             $this->module_service->insert_image("sec_image_src", $this->subject_dir, $image_settings, $this->orm->route->nazev_seo.'_red', true, 'png', 'sec_src');
         }


    }

    protected function _form_action_main_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->subject_dir, false, false, false, 'photo_src', 'ext', false);
    }

    /**
     * Akce na smazani obrazku !
     * @param <type> $data
     */
    protected function _form_action_sec_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->subject_dir, false, false, false, 'sec_src', 'ext', false);
    }


 
}