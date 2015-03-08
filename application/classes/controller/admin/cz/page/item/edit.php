<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace stranek - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Cz_Page_Item_Edit extends Controller_Hana_Edit
{
    protected $page_category=3; // typ stranek, ktere edituje tento kontroler
    protected $item_name_property=array("nazev"=>"s názvem");
    
    protected $max_tree_level=2;
    
    
    
    public function before() {
        $this->orm=new Model_Page();
        //$this->action_buttons=array_merge($this->action_buttons,array("odeslat_3"=>array("name"=>"odeslat_3","value"=>"odeslat a editovat galerii","hrefid"=>"page/item/gallery/")));
        //$this->action_buttons=array_merge($this->action_buttons,array("odeslat_2"=>array("name"=>"odeslat_na_dalsi","value"=>"odeslat a editovat další")));
        
        parent::before();
    }
    

    protected function _column_definitions()
    {
        $this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
        if($this->orm->id && !$this->orm->route_id)
        {
            // zaznam ulozen ale neni route id - docasne zvolim route_id puvodni jazykove verze
            $result=DB::select("module_id")->from("routes")->join("page_data")->on("routes.id","=","page_data.route_id")->where("page_id","=",$this->orm->id)->where("routes.language_id","=",1)->execute()->current();
            $this->auto_edit_table->row("module_id")->value($result["module_id"])->type("selectbox")->label("Typ stránek")->data_src(array("related_table_1"=>"route","related_table_2"=>"module","column_name"=>"nazev","condition"=>array("admin_zobrazit","=",1),"order_by"=>array("poradi","asc"),"orm_tree"=>false))->set();
        }
        else
        {
            $this->auto_edit_table->row("module_id")->type("selectbox")->label("Typ stránek")->data_src(array("related_table_1"=>"route","related_table_2"=>"module","condition"=>array("admin_zobrazit","=",1),"order_by"=>array("poradi","asc"),"orm_tree"=>false))->set();
            
            // TODO $this->auto_edit_table->row("module_id")->type("selectbox")->label("Typ stránek")->subquery(AutoForm_Query::factory()->select("modules.nazev")->join("routes")->on("page_data.route_id","=","routes.id")->join("modules")->on("routes.module_id","=","modules.id")->where("admin_zobrazit","=",DB::expr(1))->find_all()->nazev)->set();
        }
        $this->auto_edit_table->row("url")->css_class("data_link")->type("edit")->label("URL odkazu")->set();
        $this->auto_edit_table->row("new_window")->css_class("data_link")->type("checkbox")->label("Nové okno")->set();

        
        //$this->auto_edit_table->row("page_type_id")->type("selectbox")->label("Typ stránek")->data_src(array("related_table_1"=>"route","related_table_2"=>"page_type","column_name"=>"nazev","condition"=>array("zobrazit","=",1),"orm_tree"=>false))->set();
        $this->auto_edit_table->row("nazev_seo")->type("edit")->data_src(array("related_table_1"=>"route"))->label("Název SEO")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
        $this->auto_edit_table->row("nadpis")->type("edit")->label("Nadpis")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        
        if($this->max_tree_level>1)
        {
            $this->auto_edit_table->row("parent_id")->type("selectbox")->label("Nadřazená stránka")->item_settings(array("max_tree_level"=>$this->max_tree_level))->data_src(array("column_name"=>"nazev","orm_tree"=>true,"null_row"=>"---","language"=>true,"condition"=>array("page_category_id","=",$this->page_category)))->set();
            //$this->auto_edit_table->row("direct_to_sublink")->type("checkbox")->label("Na první podstránku")->set();      
        }
        
        $this->auto_edit_table->row("description")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("keywords")->type("edit")->label("Klíčová slova")->set();
        //$this->auto_edit_table->row("indexpage")->type("checkbox")->label("Hlavní stránka")->set();
        //$this->auto_edit_table->row("protected")->type("checkbox")->label("Chráněná (pro odborníky)")->set();
        //$this->auto_edit_table->row("show_child_pages_index")->type("checkbox")->label("Hlavní stránka")->set();
        //$this->auto_edit_table->row("show_contactform")->type("checkbox")->label("Vložit kontaktní formulář")->set();
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->data_src(array("related_table_1"=>"route"))->default_value(1)->label("Zobrazit")->set();
        //$this->auto_edit_table->row("no_link")->type("checkbox")->default_value(0)->label("Vypnout odkaz")->set();

        
        $this->auto_edit_table->row("main_image_src")->type("filebrowser")->label("Zdroj obrázku")->set();
        $this->auto_edit_table->row("main_image")->type("image")->item_settings(array("dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"jpg","delete_link"=>true))->label("Náhled obrázku")->set();
        
        $this->auto_edit_table->row("icon_image_src")->type("filebrowser")->label("Obrázek na homepage")->set();
        $this->auto_edit_table->row("icon_image")->type("image")->item_settings(array("db_col_name"=>"icon_src","dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"png","delete_link"=>true))->label("Náhled obrázku")->set();

        //$this->auto_edit_table->row("show_photo_detail")->type("checkbox")->default_value(1)->label("Zobrazit obrázek na detailu stránky")->set();
        //$this->auto_edit_table->row("youtube_code")->type("edit")->label("Youtube kód")->condition("vkládejte odkaz na Youtube video ve tvaru např: http://www.youtube.com/embed/l_cb6WtaY0k")->set();
        
        $this->auto_edit_table->row("popis")->type("editor")->label("Hlavní text")->set();
        $this->auto_edit_table->row("uvodni_popis")->type("editor")->label("Úvodní text")->set();
        
        $this->auto_edit_table->row("nav_class")->type("edit")->label("Třída prvku")->set();
        
        
        
        // obsluzny jquery
        $jquery='
            $(document).ready(function(){
                if($("#item_module_id select").val()==2){
                    $(".data_link").show();
                    $(".data_no_link").hide();
                }else{
                    $(".data_link").hide();
                    $(".data_no_link").show();
                }

                $("#item_module_id select").change(function(){
                    if($("#item_module_id select").val()==2){
                        $(".data_link").show();
                        $(".data_no_link").hide();
                    }else{
                        $(".data_link").hide();
                        $(".data_no_link").show();
                    }
                });
            });
        
        ';
        $this->auto_edit_table->add_script($jquery);
        
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
        
        $data["page_category_id"]=$this->page_category;


        // pokud bude vybran typ stranek odkaz a zaroven nazev seo bude shodne s url, prepneme na typ "stranky"
        if($data["module_id"]==2 && ($data["nazev_seo"]==$data["url"] || ("/".$data["nazev_seo"])==$data["url"]))
        {
           $data["module_id"]=1;
           $data["module_action"]="detail";

        }
        elseif($data["module_id"] == 16) // je-li sitemap
        {
            $data["module_id"] = 1;
            $data["module_action"] = "sitemap";
        }
        else
        {
            // zjistime zda jde o indexovou stranku
            $homepage_seo=Service_Route::get_language_index_seo($this->admlang."-");
            if($homepage_seo==$data["nazev_seo"])
            {
                $data["module_action"]="index";
            }
            else
            {
                $data["module_action"]=(/*$data["indexpage"] || */$data["module_id"]!=1)?"index":"detail";
            } 
        }
        
        // zjisteni route_id nadrazene stranky
//        if($data["parent_id"]!=0)
//        {
//            $data["parent_route_id"]=DB::select("page_data.id")->from("routes")->join("page_data")->on("routes.id","=","page_data.route_id")->where("page_data.page_id","=",$data["parent_id"])->as_object()->execute()->current()->id;
//        }
        
       
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

       if(isset($_FILES["icon_image_src"]) && $_FILES["icon_image_src"]["name"])
       {
           // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
           $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo");
           $this->module_service->insert_image("icon_image_src", $this->subject_dir, $image_settings, $this->orm->route->nazev_seo.'_icon',true,'png','icon_src');
       }
       
       // po uprave struktury stranek smazu kazdopadne cache a to pro vsecky jazyky (mohla byt zmena poradi ci jine spolecne veci)
       Hana_Navigation::instance()->delete_navigation_cache($this->page_category);
        
    }

    /**
     * Akce na smazani obrazku !
     * @param <type> $data
     */
    protected function _form_action_main_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->subject_dir);
    }
    
    protected function _form_action_icon_image_delete($data)
    {
        $this->module_service->delete_image($data["delete_image_id"], $this->subject_dir, false, false, false, 'icon_src', 'ext', false);
    }
}