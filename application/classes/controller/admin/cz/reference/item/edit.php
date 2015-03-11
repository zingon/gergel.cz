<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Cz_Reference_Item_Edit extends Controller_Hana_Edit
{
	
	public function before(){
		$this->orm = new Model_Reference();
		parent::before();
	}

	protected function _column_definitions(){
		$this->auto_edit_table->row("id")->item_settings(array("with_hidden"=>true))->label("# ID")->set();
        $this->auto_edit_table->row("nazev")->type("edit")->label("Název")->condition("Položka musí mít minimálně 3 znaky.")->set();
        $this->auto_edit_table->row("nazev_seo")->type("edit")->data_src(array("related_table_1"=>"route"))->label("Název SEO")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Title")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();

        $this->auto_edit_table->row("zobrazit")->type("checkbox")->data_src(array("related_table_1"=>"route"))->default_value(1)->label("Zobrazit")->set();

        $this->auto_edit_table->row("main_image_src")->type("filebrowser")->label("Zdroj obrázku")->set();
        $this->auto_edit_table->row("main_image")->type("image")->item_settings(array("dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"png","delete_link"=>true))->label("Náhled obrázku")->set();

         $this->auto_edit_table->row("icon_image_src")->type("filebrowser")->label("Obrázek na homepage")->set();
        $this->auto_edit_table->row("icon_image")->type("image")->item_settings(array("db_col_name"=>"icon_src","dir"=>$this->subject_dir,"suffix"=>"at","ext"=>"png","delete_link"=>true))->label("Náhled obrázku")->set();
        
        $this->auto_edit_table->row("popis")->type("editor")->label("Hlavní text")->set();

    }

     protected function _form_action_main_prevalidate($data) {
        parent::_form_action_main_prevalidate($data);
        // specificka priprava dat, validace nedatabazovych zdroju (pripony obrazku apod.)

        if(!$data["nazev_seo"] && $data["nazev"]){
            $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev"]); $data["nazev_seo"]=$data["nazev_seo"];
        }elseif($data["nazev_seo"]){
            $data["nazev_seo"]=seo::uprav_fyzicky_nazev($data["nazev_seo"]);
        }
        
        if(!$data['title']&& $data["nazev"]){
          $data['title'] = $data["nazev"];
        }

     	$data["module_id"]=18;
        $data["module_action"]="detail";
        
        
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
           $this->module_service->insert_image("main_image_src", $this->subject_dir, $image_settings, $this->orm->route->nazev_seo,true,'png');
       }

        if(isset($_FILES["icon_image_src"]) && $_FILES["icon_image_src"]["name"])
       {
           // nahraju si z tabulky settings konfiguracni nastaveni pro obrazky - tzn. prefixy obrazku a jejich nastaveni
           $image_settings = Service_Hana_Setting::instance()->get_sequence_array($this->module_key, $this->submodule_key, "photo");
           $this->module_service->insert_image("icon_image_src", $this->subject_dir, $image_settings, $this->orm->route->nazev_seo.'_icon',true,'png','icon_src');
       }
       // po uprave struktury stranek smazu kazdopadne cache a to pro vsecky jazyky (mohla byt zmena poradi ci jine spolecne veci)
      // Hana_Navigation::instance()->delete_navigation_cache($this->page_category);
        
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