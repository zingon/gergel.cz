<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * Zakladni kontroler pro editaci zaznamu - sablona.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

abstract class Controller_Hana_Edit extends Controller_Hana_Auth {
    
    public $template="admin/admin_content";

    protected $table_template="admin/edit/base_edit";

    protected $subject_dir;

    // promenne ktere je nutno predefinovat ve zdedenem konkretnim kontroleru
    
    // orm atribut s názvem položky (pro nadpis editu)
    protected $item_name_property=array("id"=>"s ID");
    
    // tlacitko zpet
    protected $back_link=true;
    protected $back_link_url;
    protected $back_link_text="Zpět na seznam";
    
    // klonovatelnost
    protected $cloneable=true; // nastavi klonovatelnost polozky
    protected $clone_link_text="Klonovat texty";
    
    protected $copy_lang_link=true;

    // presmerovani po odeslani
    protected $send_link_url;

    // spodni tlacitka, ktere budou soucasti editu
    protected $action_buttons=array("ulozit"=>array("name"=>"ulozit","value"=>"odeslat a zůstat zde"),
                                    "odeslat"=>array("name"=>"odeslat","value"=>"odeslat")
                                    );


    // auto-generovane promenne k dispozici vnorenym metodam
    protected $tree_mode=false;  // priznak, zda pocitat se stromem (pri generovani poradi, apod.)
    protected $order_mode=false; // priznak, se uplatnuje poradi
    protected $base_admin_path; // cesta k aktualnimu editu bez query stringu

    
    // interni promenne
    protected $orm; // orm objekt pouzity pro vylistovani
    protected $orm_route; // orm routes (dostupny pouze pokud je nastaveno $with_route)


    protected $data_processing_errors=array(); // promenna obsahujici chybove informace z prubehu zpracovani odeslanych dat
    protected $data_saved=false;

    protected $admlang=1; // defaultni jazyk
    
    private $new_item=false;
    
    private $jazverze;
    
    private $puvodni_poradi;

    /**
     *
     * @var AutoForm_Edit
     */
    protected $auto_edit_table;

    /**
     *
     * @var Service_Hana_Module
     */
    protected $module_service;

    
    public function before() {
        parent::before();
        
        // nasetovani zakladniho prostredi editu
        $this->table=new View($this->table_template);
        if($this->action_buttons) $this->table->action_buttons=$this->action_buttons;
        $this->auto_edit_table=new AutoForm_Edit("edit_table", $this->table); // inicializace editacni tabulky
        $this->module_service=new Service_Hana_Module($this->orm);      // inicializace genericke modulove servisy (vyrizuje standardni modulove CRUD pozadavky)

        $columns=$this->orm->table_columns();
        if(isset($columns["parent_id"])) $this->tree_mode=true;
        if(isset($columns["poradi"])) $this->order_mode=true;
        $this->base_admin_path=url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/".$this->subaction_key."/".($this->item_page?"".$this->item_page:"").($this->item_id?"/".$this->item_id:"");

        $this->subject_dir=$this->module_key."/".$this->submodule_key."/";
        
        // vlozeni zakladnich hodnot do sablony - nazvy, zpetne linky apod.
        if($this->back_link) $this->table->back_link=($this->back_link_url)?$this->back_link_url:url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/list".($this->item_page?"/".$this->item_page:"/1");
        $this->table->back_link_text=$this->back_link_text;
        $this->table->form_url=$this->base_admin_path;

            
        if($this->orm instanceof ORM_Language)
        {
            $lang_config=Kohana::config("languages");
            if($lang_config->get("enabled")===true)
            {
  
                $lang_array=$lang_config->get("mapping");

                $sess=Session::instance();
                if(isset($_GET["admlang"])) $sess->set("admlang", $_GET["admlang"]);
                              
                if($sess->get("admlang")) $this->admlang=$sess->get("admlang");
                
                if(isset($_GET["copylang"]))
                {
                    $this->orm->language(1); 
                }
                else
                {
                   $this->orm->language($this->admlang);
                   
                }
                
                $this->table->edtiable_languages=$lang_array;
                $this->table->main_language=$lang_array[1];
                $this->table->sel_language_id=$this->admlang;
                $this->table->copy_lang_link=$this->copy_lang_link;
                $this->table->disable_other_languages=($this->item_id)?false:true;
                
                $this->jazverze=" (ve verzi: ".$lang_array[$this->admlang]." )";
            }
            else
            {
                $this->orm->language(1); // jazyky nejsou zapnuty - plnim pouze vychozi jaz verzi id:1
            }
   
        }
        
        // castecne klonovani bude zatim dostupne jen v zakladni jazykove verzi
        if($this->cloneable && (!($this->orm instanceof ORM_Language) || $this->orm->get_selected_language_id()==1)) 
        {
            $this->table->clone_link=($this->base_admin_path."?action=clone").(($this->admlang)?("&admlang=".$this->admlang):"");
            $this->table->clone_link_text=$this->clone_link_text;
        }else{
            $this->table->clone_link="";
        }        
    }

    /**
     * Hlavni sekvence prubehu zpracovani editu.
     */
    public function action_index()
    {
        // nastaveni listovaci tabulky
        $this->_table_options();

        // nasetovani ormka podle toho zda jde o editaci nebo novy zaznam
        $this->_orm_preparation($this->item_id);

        // nastaveni sloupcu tabulky
        $this->_column_definitions();

        // predgenerovani tabulky
        $form_data = $this->auto_edit_table->pregenerate($this->orm);

        // provedeni uzivatelskych akci
        // zjistim zda doslo k editaci
        //$data_submit=(isset($_POST["ulozit"]) || isset($_POST["odeslat"]))?true:false;
        $form_data=$this->_action_router($form_data);
        
        $message="";
        // vyrendrovani tabulky jako zdroj dat slouzi bud orm objekt, nebo jsou-li data z formulare, pak tato data
        
        if($this->data_saved)
        {
            // data byla uspesne zpracovana a ulozena
            if(isset($_POST["ulozit"])) Request::instance()->redirect(url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/".$this->subaction_key."/".($this->item_page?"".$this->item_page:"1")."/".$this->orm->id."?message=ok");
            if(isset($_POST["odeslat"])) Request::instance()->redirect($this->send_link_url?($this->send_link_url."?message=ok&affected_rowid=".$this->orm->id):(url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/list".($this->item_page?"/".$this->item_page:"/1")."?message=ok&&affected_rowid=".$this->orm->id));
            if(isset($_POST["odeslat_na_dalsi"])) Request::instance()->redirect($this->send_link_url?($this->send_link_url."?action=ok_next&last_id=".$this->item_id):(url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/list".($this->item_page?"/".$this->item_page:"/1")."?action=ok_next&last_id=".(($this->new_item)?0:$this->item_id)));
            
            // prechod na jinou adresu

               foreach($this->action_buttons as $but_key=>$but_value)
               {
                   if(array_key_exists($but_key, $_POST)) Request::instance()->redirect(url::base().Kohana::$index_file."admin/".$but_value["hrefid"].($this->item_page?"".$this->item_page:"1")."/".$this->orm->id."?message=ok");;
               }


            if(!request::$is_ajax)
            {
                // standardne prejdu na ten samy kontroller
                Request::instance()->redirect(url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/".$this->subaction_key."/".($this->item_page?"".$this->item_page:"1")."/".$this->orm->id."?message=highlight");
            }
            else
            {
                $message="highlight";
            }

        }else{
            //print_r($this->auto_edit_table->generate($this->orm));

            if(!empty($this->data_processing_errors))
            {
                $form_data["form_errors"]=$this->data_processing_errors;           // vlozime chyby k datum z formulare
                $this->auto_edit_table->row_errors=$this->data_processing_errors;  // vlozime chyby do sablony
 
                $message="error";

            }
        }
        //print_r($form_data);

        // zobrazeni pripadne zpravy
        if(isset($_GET["message"])) $message=$_GET["message"];

        $this->table->message=$message;
        $response = $this->auto_edit_table->generate((isset($form_data["hana_form_action"]) && $form_data["hana_form_action"])?$form_data:$this->orm);
        
        if($this->item_id)
        {
            // popisek editu bude brán ze základní verze
            if(is_array($this->item_name_property))
            {        
                $property=key($this->item_name_property);
                $it_nazev="";//$this->orm->{key($this->item_name_property)};
                if(empty($it_nazev)){
                    if($this->orm instanceof ORM_Language)
                    {
                        if($this->orm->is_language_property($property))
                        {
                            $result=db::select(array($property,"it_nazev"))->from(strtolower($this->orm->object_name())."_data")->where("language_id","=",1)->where($this->orm->object_name()."_id","=",$this->orm->id)->execute()->current();
                            $it_nazev = $result["it_nazev"];
                        }
                        else
                        {
                            $it_nazev = $this->orm->$property;
                        }

                    }
                    else
                    {
                        $it_nazev=$this->orm->{key($this->item_name_property)};
                    }
                }
                $this->template->submodule_description="editace položky ".$this->item_name_property[$property].": ".$it_nazev.$this->jazverze;
            }
            else
            {
                $this->template->submodule_description=$this->item_name_property;
            }

        }
        else
        {
            $this->table->clone_link="";
            $this->template->submodule_description="přidání nové položky";
        }
        
        $this->template->admin_content = $response;
        //$this->request->response=$this->template->render();

    }

    /////////////////////////////////////////////////////////////
    // nasleduji prepisovatelne metody jednotlivych fazi generovani tabulky

    protected function _table_options()
    {
        
    }

    protected function _orm_preparation($id=0)
    {
        if($id && (!isset($_POST["id"]) || $_POST["id"]!="-c-"))
        {
            $this->orm->find($id);
        }
        else
        {
            $this->orm->reset();
        }
    }

    /**
     * Metoda, ve ktere se definuji jednotlive sloupce tabulky.
     */
    protected function _column_definitions()
    {

    }

    /**
     * Metoda ktera osetruje smerovani pozadavku na akce v reakci na obdrzena data.
     * na kazdou akci pripada sada tri metod (nepovine) prevalidacni akce, validace, postvalidacni akce
     */
    protected function _action_router($data)
    {
        if(isset($data["hana_form_action"]))
        {
            $action=$data["hana_form_action"];
        }
        elseif(isset($_GET["action"]))
        {
            $action=$_GET["action"];
        }
        else
        {
            $action = (isset($_POST["hana_form_action"]))?$_POST["hana_form_action"]:false; // beru vychozi akci po odeslani formulare TODO - mozna definovat dynamicky
            $data["hana_form_action"]=$action;
        }
        

        if($action)
        {
            //die(print_r($data).print_r($_POST));

            // 0) obycejna jednorazova akce
            $standard_action="_form_action_".$action."";
            if(method_exists($this, $standard_action))
            {
                $data=$this->$standard_action($data);
                return $data;
            }
            
            // 1) prevalidace
            $prevalidation_method="_form_action_".$action."_prevalidate";
            if(method_exists($this, $prevalidation_method)) $data=$this->$prevalidation_method($data);
            if(!empty($this->data_processing_errors)) return $data;

            // 2) validace
            $validation_method="_form_action_".$action."_validate";
            if(method_exists($this, $prevalidation_method)) $data=$this->$validation_method($data);
            if(!empty($this->data_processing_errors)) return $data;


            // 3) postvalidace
            $postvalidation_method="_form_action_".$action."_postvalidate";
            if(method_exists($this, $prevalidation_method)) $data=$this->$postvalidation_method($data);
            if((isset($_POST["id"]) && $_POST["id"]=="-c-"))
            {
                $data=$this->_form_action_postvalidate_clone($data);
            }
            //if(!empty($this->data_processing_errors)) return $data;
        }
        return $data;
    }

    /////////////////////////////////////////////////////////////
    // nasleduji definice jednotlivych standardnich akci spustenych uzivatelem

    /**
     * Obecna metoda, ktera se vykona pri kazde operaci.
     * @param array $data
     */
    protected function _form_action_default($data)
    {
        // lze osetrovat datumy zmeny, nebo logovat uzivatele a jeho akce...

    }
    
    /**
     * Jednoducha implementace klonovani zaznamu (klonuje se pouze entita, pripojene entity a zdroje mozno doimplementovat v teto metode)
     * Prvni pruchod - stisknuti tlacitka "klonovat", pripadne zmeny v ormku, ktere se projevi nasledne v zobrazenem formulari.
     * @param type $data 
     */
    protected function _form_action_clone($data)
    {
        $this->orm->id="-c-"; $this->item_id=0;  // -c- je klíčové slovo, které se kontroluje
        $this->template->disable_other_languages=true;
    }
    
    /**
     * Jednoducha implementace klonovani zaznamu (klonuje se pouze entita, pripojene entity a zdroje mozno doimplementovat v teto metode)
     * Druhy pruchod - ulozeni klonovaneho zaznamu. Misto pro pripadne postvalidacni zpracovani dat.
     * @param type $data 
     */
    protected function _form_action_postvalidate_clone($data)
    {
//        $old_id=Request::instance()->param("id");
    }

    /**
     * Metoda, ktera se vyvola pred validaci - zajistuje upravu obdrzenych dat.
     * @param array $data
     */
     protected function _form_action_main_prevalidate($data)
     {
         if($this->tree_mode) $this->puvodni_poradi=$this->orm->parent_id; 
        
         return $data;
     }

     /**
      * Metoda, ktera zajistuje validaci dat pred ulozenim. Validace probehne volitelne nad modelem routes a nad hlavnim modelem.
      * @param <type> $data
      */
     protected function _form_action_main_validate($data)
     {
         // overeni, ze nezarazujeme za stejnou kategorii
         if($this->tree_mode && $this->orm->id && isset($data["parent_id"]) && $this->orm->id==$data["parent_id"])
         {
            $this->data_processing_errors["parent_id"]=Kohana::message('validate', "self_reference");
            return $data;
         }

         // TODO - upravit
           $process_data=$data;
           unset($process_data["id"]);

           if($this->orm instanceof ORM_Language && $this->orm->is_join_on_routes())
           {
               $this->orm_route=$this->orm->route;
               $this->orm_route->values($process_data);
               $this->orm_route->language_id=$this->admlang;
               if($this->orm_route->check())
               {
                   // testy v "routes" prosly, prechazim na testovani hlavniho objektu
                   //die("validace routes ok<br />");
                   $this->orm->values($process_data);

                   
                   
                   if($this->orm->check())
                   {
                        //die("validace hlavniho objektu ok<br />");
                        return $data;
                   }
                   else
                   {
                       $this->data_processing_errors = array_merge($this->data_processing_errors, $this->orm->validate()->errors('form_errors'));
                       
                       
                   }
               }
               else
               {
                   $this->data_processing_errors = array_merge($this->data_processing_errors, $this->orm_route->validate()->errors('form_errors'));
                   //validace na objektu neprosly - doplnim validacni chyby z hlavniho objektu
                   $this->orm->values($process_data);
                   $this->orm->check();
                   $this->data_processing_errors = array_merge($this->data_processing_errors, $this->orm->validate()->errors('form_errors'));
               }
           }
           else
           {
               $this->orm->values($process_data);
               if($this->orm->check())
               {
                    return $data;
               }
               else
               {
                   $this->data_processing_errors = array_merge($this->data_processing_errors, $this->orm->validate()->errors('form_errors'));
               }
           }
           return $data;
     }

     /**
      * Metoda, ktera se vola po uspesne validaci dat, provede vsechny dodatecne akce (obsluhu vlozeni obrazku apod.)
      * @param <type> $data
      */
     protected function _form_action_main_postvalidate($data)
     {
        // ulozim zvalidovane objekty
        if($this->orm instanceof ORM_Language && $this->orm->is_join_on_routes())
        {
            $orm_class_name=$this->orm->get_class_name();
            $orm_language_class_name=$this->orm->get_language_class_name();
            
            $orm_route=Service_Route::save_route($this->orm_route,$this->orm->id,$orm_class_name,$orm_language_class_name);
            $this->orm->route_id=$this->orm_route->id;
        }
        
        if(!(int)$this->orm->id>0) $this->new_item=true;

        //$this->orm->save();
        
        if(isset($this->orm->available_languages) && ((int)$this->orm->available_languages & (int)$this->orm->get_selected_language_id())==0)
        {
            $this->orm->available_languages=$this->orm->available_languages+$this->orm->get_selected_language_id();
        }

        // ulozeni ORM objektu
        // vygenerovat poradi - pokud je dovoleno a uz predtim nebylo stanoveno (s rozlisenim ORM tree), prerazeni do jine vetve inicializuje tez pozadavek na nove poradi
        
        if($this->order_mode && (!$this->orm->poradi || ($this->tree_mode && $this->orm->parent_id!=$this->puvodni_poradi)))
        {
            $order = $this->module_service->get_new_order_position($this->orm, $this->tree_mode);
            $this->orm->poradi = $order;
        }
        

        $this->orm->save();

        // smazu cache
        if($this->cache) Cache::instance()->delete("navigation_structure"); 

        $this->data_saved=true;
        return($data);
        
     }

}
?>