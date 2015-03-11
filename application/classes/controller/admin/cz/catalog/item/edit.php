<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace jednoducheho produktoveho katalogu - list.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2013 Pavel Herink
 */

class Controller_Admin_Cz_Catalog_Item_Edit extends Controller_Hana_Edit
{
    protected $with_route=true;
    protected $item_name_property=array("nazev"=>"s názvem");
    

    public function before() {
        $this->orm=new Model_Catalog();
        //$this->action_buttons=array_merge($this->action_buttons,array("odeslat_3"=>array("name"=>"odeslat_3","value"=>"odeslat a editovat galerii","hrefid"=>"catalog/item/gallery/")));
        
        parent::before();
        $this->image_dir=$this->module_key."/".$this->submodule_key."/";
        $this->subject=strtolower($this->orm->class_name);
        $this->subject_col_id_name=$this->subject."_id";
        $this->subject_files_name=$this->subject."_file";
    }

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
        $this->auto_edit_table->row("product_category_id")->type("selectbox")->label("Kategorie")->data_src(array("related_table_1"=>"product_category","column_name"=>"nazev","condition"=>array("zobrazit","=",1),"orm_tree"=>true))->set();
        //$this->auto_edit_table->row("product_category_id")->type("selectbox")->label("Kategorie")->item_settings(array("HTML"=>array("multiple"=>"multiple","style"=>"height: 200px")))->data_src(array("related_table_1"=>"product_categories","column_name"=>"nazev","orm_tree"=>true,"multiple"=>true,"condition"=>array("language_id","=",1)))->set();
        
        $this->auto_edit_table->row("nazev_seo")->type("edit")->data_src(array("related_table_1"=>"route"))->label("Název SEO")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("description")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("keywords")->type("edit")->label("Klíčová slova")->set();
        
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->default_value(1)->label("Zobrazit")->set();
        //$this->auto_edit_table->row("homepage")->type("checkbox")->default_value(1)->label("Zobrazit na úvodní stránce")->set();

        //$this->auto_edit_table->row("main_image_src")->type("filebrowser")->label("Zdroj obrázku (bílý)")->set();
        //$this->auto_edit_table->row("main_image")->type("image")->item_settings(array("dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"png","delete_link"=>true))->label("Náhled obrázku")->set();

        //$this->auto_edit_table->row("sec_image_src")->type("filebrowser")->label("Zdroj obrázku (červený)")->set();
        //$this->auto_edit_table->row("sec_image")->type("image")->item_settings(array("db_col_name"=>"sec_src","dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"png","delete_link"=>true))->label("Náhled obrázku")->set();
        //$this->auto_edit_table->row("youtube_code")->type("edit")->label("Youtube kód")->condition("Youtube kód ve tvaru např.: http://youtu.be/_cEzpe04gOo")->set();


        //$this->auto_edit_table->row("uvodni_popis")->type("textarea")->label("Úvodní text (stručný popis)")->set();
        $this->auto_edit_table->row("popis")->type("editor")->label("Text")->set();
        $this->auto_edit_table->row("odborne_informace")->type("editor")->label("Technické informace")->set();
        //$this->auto_edit_table->row("parametry")->type("editor")->label("Parametry")->set();

        //$this->auto_edit_table->row("L2")->variant("one_col")->value("Soubory připojené k produktu")->type("label")->set();

        /*if($this->orm->id)
        {
            $this->auto_edit_table->row("product_file")->item_settings(array("orm"=>$this->orm,"title"=>"Soubor","item"=>"nazev","description"=>"","value"=>array("product_file_data.nazev","phodnota"),"files_order_by"=>array("nazev"=>"asc")))->value("Seznam souborů")->type("microeditfile")->set();
        }
        else
        {
            $this->auto_edit_table->row("L12")->value("Před přidáváním souborů musí být produkt nejprve uložen")->type("text")->set();
        }*/
        
        //$this->auto_edit_table->row("preferred")->type("checkbox")->value(0)->label("Zobrazit na úvodní straně")->set();
        
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
        $data["module_action"]="detail";
        $data["module_id"]=db::select("id")->from("modules")->where("kod","=","catalog")->execute()->get("id");

        return $data;
    }

    
    /*protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);

       // ulozim k produktu reference na vybrane kategorie
       //$this->module_service->bind_categories($data['product_category_id'],'product_category','product_categories');


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

    }*/

    /**
     * Akce na smazani obrazku !
     * @param <type> $data
     */
    /*protected function _form_action_main_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->subject_dir, false, false, false, 'photo_src', 'ext', false);
    }*/

    /**
     * Akce na smazani obrazku !
     * @param <type> $data
     */
   /* protected function _form_action_sec_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->subject_dir, false, false, false, 'sec_src', 'ext', false);
    }*/
    
    
   /* protected function _form_action_microedit_product_file_add($data)
    {
        $errors="";
        // primitivni predvalidovani dat
        //if(!$data["nazev"]) $errors["nazev"]="musí být zadán název";
        if(!$data["file_id"])
        {
            // prvni zadavani - musi byt zdroj obrazku a pokud neni nazev, vytvori se z tohoto zdroje
            if(!$_FILES['microedit_file_src']["name"]) $errors["src"]="musí být vybrán soubor obrázku";
            if(empty($errors) && !$data["nazev"]) $data["nazev"]=Service_Hana_File::get_raw_file_name($_FILES['microedit_file_src']['name']);
        }
        else
        {
            // editace - nemusi byt zdroj obrazku

            if(!$_FILES['microedit_file_src']["name"])
            {
                // 1) neni obrazek - musi byt nazev
                if(!$data["nazev"]) $errors["nazev"]="název obrázku musí být zadán";
            }
            else
            {
                // 2) je obrazek - pokud neni nazev - pouziju opet nazev z obrazku
                if(!$data["nazev"]) $data["nazev"]=Service_Hana_File::get_raw_file_name($_FILES['microedit_file_src']['name']);
            }

        }
        // validace probehly, data jsou predzpracovana, prejdu k procesu jejich ulozeni

        // vlastni zpracovani dat
        if(empty($errors))
        {
            
            // ziskani vychoziho ormka v zavislosti na tom, zda jde o editaci nebo novou polozku
            if($data["file_id"])
            {
                $subject_files=orm::factory($this->subject_files_name)->language($this->orm->get_selected_language_id())->where($this->subject."_files.id","=",$data["file_id"])->find();
               
            }
            else
            {
                $subject_files=orm::factory($this->subject_files_name)->language($this->orm->get_selected_language_id());
            }

            // predam data ke zpracovani a ulozeni modulove servise
            $result=$this->module_service->insert_file($subject_files, $this->subject_col_id_name, $this->item_id, "microedit_file_src", $this->subject_dir, $data);
        }

        // pokud servisa vrati chybu, pridam ji do chyb
        if(isset($result) && $result !== true) $errors=$result;

        // zhodnoceni vysledku
        if($errors)
        {
            // neuspesne zpracovani dat
            $this->data_processing_errors=$errors; // nastaveni chyby
            $data["action"]="main_gallery_editphoto"; // toto nastaveni zpusobi, ze se otevre znovu dialogove okno
            return($data);

        }
        else
        {
            // uspesne zpracovani dat
            $this->data_saved=true;
        }
    }

    protected function _form_action_microedit_product_file_delete($data)
    {
        $orm=orm::factory($this->subject_files_name);
        $this->module_service->delete_file($data["delete_file_id"], $this->subject_dir, $orm, $this->subject_col_id_name);
        $this->data_saved=true;
    }*/

}