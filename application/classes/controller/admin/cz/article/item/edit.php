<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace clanku - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Controller_Admin_Cz_Article_Item_Edit extends Controller_Hana_Edit
{
    protected $with_route=true;
    protected $item_name_property=array("nazev"=>"s názvem");
    

    public function before() {
        $this->orm=new Model_Article();
        $this->action_buttons=array_merge($this->action_buttons,array("odeslat_3"=>array("name"=>"odeslat_3","value"=>"odeslat a editovat galerii","hrefid"=>"cz/article/item/gallery/")));
        
        parent::before();
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("date")->type("datepicker")->label("Datum")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
        $this->auto_edit_table->row("nazev_seo")->type("edit")->data_src(array("related_table_1"=>"route"))->label("Název SEO")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
        $this->auto_edit_table->row("nadpis")->type("edit")->label("Nadpis")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("description")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("keywords")->type("edit")->label("Klíčová slova")->set();
        
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->default_value(1)->label("Zobrazit")->set();
        
        $this->auto_edit_table->row("main_image")->type("image")->item_settings(array("dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"jpg","delete_link"=>true))->label("Náhled obrázku")->set();
        $this->auto_edit_table->row("main_image_src")->type("filebrowser")->label("Zdroj obrázku")->set();
        //$this->auto_edit_table->row("gallery_id")->type("selectbox")->label("Připojit galerii")->data_src(array("related_table_1"=>"gallery","order_by"=>array("poradi","asc"), "null_row" => "Žádná galerie"))->set();
        $this->auto_edit_table->row("uvodni_popis")->type("editor")->label("Úvodní text")->set();
        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();
        $this->auto_edit_table->row("L2")->variant("one_col")->value("Soubory připojené k novince")->type("label")->set();
        //$this->auto_edit_table->row("download_id")->type("selectbox")->label("Soubory")->item_settings(array("HTML"=>array("multiple"=>"multiple","style"=>"height: 200px")))->data_src(array("related_table_1"=>"downloads","column_name"=>"nazev","orm_tree"=>false,"multiple"=>true))->set();

        //$this->auto_edit_table->row("preferred")->type("checkbox")->value(0)->label("Zobrazit na úvodní straně")->set();
        
    }

    protected function _form_action_main_prevalidate($data) {
        parent::_form_action_main_prevalidate($data);
        // specificka priprava dat, validace nedatabazovych zdroju (pripony obrazku apod.)
        if(!$data["title"] && $data["nazev"]){$data["title"]=$data["nazev"];}
        if(!$data["nadpis"] && $data["nazev"]){$data["nadpis"]=$data["nazev"];}

        if(!$data["nazev_seo"] && $data["nazev"]){
            $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev"]); $data["nazev_seo"]=$data["nazev_seo"];
        }elseif($data["nazev_seo"]){
            $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev_seo"]);
        }

        // defaultni akce v routes
        $data["module_action"]="detail";
        $data["module_id"]=db::select("id")->from("modules")->where("kod","=","article")->execute()->get("id");

        return $data;
    }

    
    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);

        //$this->module_service->bind_categories($data['download_id'],'download','downloads', false);

       // vlozim o obrazek
       if(isset($_FILES["main_image_src"]) && $_FILES["main_image_src"]["name"])
       {
           // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
           $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo");
           $this->module_service->insert_image("main_image_src", $this->subject_dir, $image_settings, $this->orm->route->nazev_seo);
       }
       
       if(isset($_FILES["wide_image_src"]) && $_FILES["wide_image_src"]["name"])
       {
           // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
           $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo_wide");
           $this->module_service->insert_image("wide_image_src", "article/wide_item/", $image_settings, $this->orm->route->nazev_seo, true, "jpg", "photo_wide_src");
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
    
    protected function _form_action_wide_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], "article/wide_item/", false, false, false,"photo_wide_src");
    }
}