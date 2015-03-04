<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace stranek - edit.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Cz_Page_System_Edit extends Controller_Hana_Edit
{
    protected $page_category=1; // typ stranek, ktere edituje tento kontroler
    protected $item_name_property=array("nazev"=>"s názvem");
    
    protected $max_category_level=2;
    
    public function before() {
        $this->orm=new Model_Page();
        
        
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
            $this->auto_edit_table->row("module_id")->value($result["module_id"])->type("selectbox")->label("Typ stránek")->data_src(array("related_table_1"=>"route","related_table_2"=>"module","column_name"=>"nazev","condition"=>array("available","=",1),"order_by"=>array("poradi","asc"),"orm_tree"=>false))->set();
        }
        else
        {
            $this->auto_edit_table->row("module_id")->type("selectbox")->label("Typ stránek")->data_src(array("related_table_1"=>"route","related_table_2"=>"module","module"=>"nazev","condition"=>array("available","=",1),"order_by"=>array("poradi","asc"),"orm_tree"=>false))->set();  
        }
        
        $this->auto_edit_table->row("module_action")->type("edit")->label("Akce")->data_src(array("related_table_1"=>"route"))->set();
        $this->auto_edit_table->row("param_id1")->type("edit")->label("Parametr akce")->data_src(array("related_table_1"=>"route"))->set();
        
        
        $this->auto_edit_table->row("parent_id")->type("selectbox")->label("Nadřazená stránka")->item_settings(array("max_tree_level"=>$this->max_category_level))->data_src(array("column_name"=>"nazev","orm_tree"=>true,"null_row"=>"---","language"=>true))->set();
        $this->auto_edit_table->row("show_in_menu")->type("checkbox")->label("Zobrazit v menu")->condition("(Položka bude zařazena do struktury drobítkové navigace, ale v případném menu nadřazené stránky se nezobrazí.)")->set(); 
        $this->auto_edit_table->row("direct_to_sublink")->type("checkbox")->label("Na první podstránku")->condition("(Kliknutí na tuto položku povede k zobrazení první podstránky.)")->set();
        $this->auto_edit_table->row("show_in_submenu")->type("checkbox")->label("Zahrnout do submenu")->condition("(V případě že má položka submenu, bude v něm sama zahrnuta na první místo.)")->set(); 
        
        
        //$this->auto_edit_table->row("page_type_id")->type("selectbox")->label("Typ stránek")->data_src(array("related_table_1"=>"route","related_table_2"=>"page_type","column_name"=>"nazev","condition"=>array("zobrazit","=",1),"orm_tree"=>false))->set();
        $this->auto_edit_table->row("nazev_seo")->type("edit")->data_src(array("related_table_1"=>"route"))->label("Název SEO")->condition("(Pokud nebude položka vyplněna, vygeneruje se automaticky z názvu.)")->set();
        $this->auto_edit_table->row("nadpis")->type("edit")->label("Nadpis")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        $this->auto_edit_table->row("title")->type("edit")->label("Titulek")->condition("(Pokud nebude položka vyplněna, použije se hodnota z názvu.)")->set();
        
        $this->auto_edit_table->row("description")->type("edit")->label("Popis")->set();
        $this->auto_edit_table->row("keywords")->type("edit")->label("Klíčová slova")->set();
        $this->auto_edit_table->row("poradi")->type("edit")->label("Pořadí")->set();
        
        $this->auto_edit_table->row("zobrazit")->type("checkbox")->data_src(array("related_table_1"=>"route"))->default_value(1)->label("Zobrazit")->set();
        
        $this->auto_edit_table->row("popis")->type("editor")->label("Hlavní text")->set();
        
        
        //$this->auto_edit_table->row("uvodni_popis")->type("editor")->label("Sekundární text")->set();
        
        
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

        // defaultni akce v routes
        
        $data["page_category_id"]=$this->page_category;
        
        // routa bude oznacena priznakem "interni" 
        $data["internal"]=1;
        
        
        //$data["web_type_id"]=DB::select("id")->from("web_types")->where("code","=",$this->web_type_code)->as_object()->execute()->current()->id;

        return $data;
    }
    protected function _form_action_main_postvalidate($data) {
       parent::_form_action_main_postvalidate($data);

    }



}