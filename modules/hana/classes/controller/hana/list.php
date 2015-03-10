<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Sablona kontroleru pro tabulkovy vypis polozek. Definuje jeho zakladni obecnou strukturu a poradi kroku (kod v techto krocich se da predefinovat ve zdedenych kontrolerech).
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

abstract class Controller_Hana_List extends Controller_Hana_Auth {

    public $template="admin/admin_content";
    
    protected $render_type;  // typ rendrování tabulky (nic=standardni vystup na screen, print=tisk, export=export do souboru)

    protected $submodule_description="seznam položek";

    protected $table_template="admin/list/base_list";
    protected $table_print_template="admin/list/base_print_list";

    // promenne ktere je nutno predefinovat ve zdedenem konkretnim kontroleru
    protected $with_route=false; // priznak zda se bude poctitat s napojenim na routovaci tabulku

    protected $default_order_by; // defaultni razeni - volitelne - jinak se zvoliautomaticky bud "poradi", nebo nazev
    protected $default_order_direction="asc"; // defaultni razeni -volitelne


    // spodni tlacitka, ktere budou soucasti listu
    protected $add_button=true;
    protected $delete_button=true;
    protected $save_button=false;
    protected $default_buttons=array(); // defaultni tlacitka na spodu listu 

    // auto-generovane promenne k dispozici vnorenym metodam
    protected $tree_mode=false;  // priznak, zda pocitat se stromem (pri generovani poradi, apod.)
    protected $order_mode; // priznak, zda se uplatnuje poradi
    protected $col_nazev=false;  // urcuje, zda je v tabulce dostupny sloupec "nazev" - kvuli vychozimu razeni
    
    protected $use_drag_drop_reorder=true;
    
    protected $base_path; // cesta k modulu
    protected $base_admin_path; // cesta k aktualnimu listu bez query stringu
    protected $base_path_to_edit; // defaultni cesta k editu
    protected $base_path_to_gallery; // defaultni cesta ke galerii


    protected $orm; // orm objekt pouzity pro vylistovani

    protected $data_processing_errors=array(); // promenna obsahujici chybove informace z prubehu zpracovani odeslanych dat
    protected $data_saved=false;

    protected $error_rows=array(); // idcka radku, na kterych doslo k chybe pri hromadnem ukladani dat
    
    protected $web_type_code="";
    
    protected $filtering_applied=false;

    /**
     *
     * @var AutoForm_List
     */
    protected $auto_list_table;
    /**
     *
     * @var Service_Hana_Module
     */
    protected $module_service;

    /**
     * Inicializace objektu AutoList_Table.
     */
    public function before() {
        parent::before();
        
        $this->with_route=($this->orm instanceof ORM_Language && $this->orm->is_join_on_routes());
        if($this->orm instanceof ORM_Language) $this->orm->language(1); // ve vychozi verzi v seznamu zobrazit zakladni jazyk, TODO - dodelat prepinani
        // zjisteni zpusobu prezentovani dat - standardni, tisk, export
        $this->render_type=isset($_GET["render"])?$_GET["render"]:"";
        
        switch ($this->render_type) {
            case "print":
                $this->table=new View($this->table_print_template);
                $this->table->submodule_title=$this->module_informations_orm->nadpis;
                $this->table->submodule_description=$this->submodule_description;
                $this->table->owner=$this->owner;
            
                $table_render_type="print";
                break;
            case "csv":
                $this->table=false;
                $table_render_type="export";
                break;
            default:
                $this->table=new View($this->table_template); 
                $table_render_type="";
                break;
        }
  
        $this->auto_list_table=new AutoForm_List("list_table", $table_render_type, $this->table, $this->orm, $this->module_key, $this->submodule_key, $this->subaction_key, $this->item_page); // inicializace listovaci tabulky
                
        $this->module_service=new Service_Hana_Module($this->orm);      // inicializace genericke modulove servisy (vyrizuje standardni modulove CRUD pozadavky)

        // zjistime zda pracujeme s orm_tree
        $columns=$this->orm->table_columns();
        if(isset($columns["parent_id"])) $this->tree_mode=true;
        if(isset($columns["poradi"]) && $this->order_mode!==false) $this->order_mode=true; // uzivatelske nastaveni ma prioritu
        if($this->order_mode===false) $this->use_drag_drop_reorder=false;
        if($this->default_order_by)
        {
            $this->auto_list_table->default_order_by=$this->default_order_by;
            $this->auto_list_table->default_order_direction=$this->default_order_direction;
        }
        elseif($this->order_mode)
        {
            $this->auto_list_table->default_order_by="poradi";
        }
        if(isset($columns["nazev"])) $this->col_nazev=true;
        $this->base_path=url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/";
        $this->base_admin_path=url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/".$this->subaction_key."/".$this->item_page;
        $this->base_path_to_edit=url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/edit"."/".$this->item_page;
        $this->base_path_to_gallery=url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/gallery"."/".$this->item_page;

        if($this->render_type=="")
        {        
            $this->table->form_url=$this->base_admin_path;
            // vlozeni tlacitek
            if($this->add_button) $this->table->new_link=url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/edit"; else $this->table->new_link=false;
         
            
            $this->table->delete_button=$this->delete_button;
            $this->table->save_button=$this->save_button;
            if($this->default_buttons) $this->table->default_buttons=$this->default_buttons;

            if(isset($_GET["message"])) $this->table->message=$_GET["message"];
            if(isset($_GET["error_rows"])) $this->table->error_rows=$_GET["error_rows"]; 
        }
        
        // reset nastaveny jazykovy verze z editu, pokud byla
        Session::instance()->set("admlang","");
        
        $this->auto_list_table->web_type_code=$this->web_type_code;
        
    }

    /**
     * Hlavni sekvence prubehu zpracovani listu.
     */
    public function action_index()
    {
        // nastaveni listovaci tabulky
        $this->_table_options();

        // nastaveni sloupcu tabulky
        $this->_column_definitions();

        // predgenerovani tabulky
        $form_data = $this->auto_list_table->pregenerate($this->orm);

        // provedeni uzivatelskych akci
        $this->_action_router($form_data);

        
        // zjisteni parametru pro vygenerovani ORMka
        
        $where              =$this->auto_list_table->filtering_section->get_where_rules($this->module_key, $this->submodule_key, $this->subaction_key);
        $like               =$this->auto_list_table->filtering_section->get_like_rules($this->module_key, $this->submodule_key, $this->subaction_key);
        
        if(!empty($where) || !empty($like))
        {
            $this->use_drag_drop_reorder=false;
            $this->order_mode=false;
            $this->filtering_applied=true;
            $this->auto_list_table->order_allowed=false;
        }

        // nastaveni ormka 1 - specialni uzivatelske
        $this->_orm_setup();
        // nastaveni ormka 2 - doplneni podminek
        $this->_orm_preparation_all($where, $like);

        // zjisteni parametru tabulky na zaklade aktualni DB a filtrovani - mel by zajistovat kompletne AutoForm_Table
        $this->auto_list_table->prepare();

        $order_by           =$this->auto_list_table->order_by;
        $order_direction    =$this->auto_list_table->order_direction;
        $limit              =$this->auto_list_table->limit;
        $offset             =$this->auto_list_table->offset;

        
        // DOPLNENO - presmerovani na edit dalsi polozky z vyfiltrovaneho seznamu
        if(isset($_GET["action"]) && $_GET["action"]=="ok_next")
        {
             if($_GET["last_id"]>0) 
             {
                 $next_id=$this->_get_next_item_id($order_by, $order_direction, $limit, $offset, $_GET["last_id"]);

                 if($next_id)
                 {
                     Request::instance()->redirect(url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/edit/".($this->item_page?"".$this->item_page:"1")."/".$next_id."?message=ok");
                 }
                 else
                 {
                     Request::instance()->redirect(url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/list".($this->item_page?"/".$this->item_page:"/1")."?message=ok");
                 }
             }
             else
             {
                 Request::instance()->redirect(url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/edit?message=ok");
             }
        }
        else
        {    
        // nastaveni ormka 3 - doplneni limitu a razeni, zaverecne provedeni celeho dotazu
        $this->_orm_preparation_list($order_by, $order_direction, $limit, $offset);
        }

        // vyrendrovani tabulky
        if(is_object($this->table))
        {
            if($this->render_type=="" && $this->auto_list_table->filterable) $this->table->filter_button=true; else $this->table->filter_button=false;
            if($this->auto_list_table->order_by=="poradi" && $this->use_drag_drop_reorder){
                $this->table->drag_reorder=true;
            }
            else
            {
                $this->table->drag_reorder=false;
            }
        }
        
        $error_rows="";
        $message="";

        if($this->data_saved)
        {
            // pokud je pouzita cache, provedu jeji smazani
            //if($this->cache) Cache::instance()->delete("navigation_structure_".$this->web_type_code);

            if(!empty($this->error_rows))
            {
                // data byla sice ulozena, v nekterych polozkach doslo k chybe
                $error_rows=implode(", ", $this->error_rows);
                $query_string="?message=highlight&error_rows=".$error_rows;
            }
            elseif(is_string($this->data_saved))
            {
                $query_string="?message=".$this->data_saved;
            }
            else
            {
                // vsechna data byla ulozena bez chyby
                $message="ok";
                $query_string="?message=".$message;
            }
            
            if(!request::$is_ajax)
            {
                Request::instance()->redirect(url::base().Kohana::$index_file."admin/".i18n::lang()."/".$this->module_key."/".$this->submodule_key."/".$this->subaction_key."".$query_string);
            }
            
            
        }else{
            //print_r($this->auto_edit_table->generate($this->orm));
            if(!empty($this->data_processing_errors))
            {
                $form_data["form_errors"]=$this->data_processing_errors;                       // vlozime chyby k datum z formulare kvuli kterym nemohl byt ulozen
                $this->auto_list_table->data_processing_errors=$this->data_processing_errors;  // vlozime chyby do sablony
            }

        }

        if(isset($_GET["message"])) $message=$_GET["message"];
        if(isset($_GET["error_rows"])) $error_rows=$_GET["error_rows"];

        if($message) $this->template->message=$message;
        if($error_rows) $this->template->error_rows=$error_rows;

        //$this->template->admin_content = $this->auto_list_table->generate((isset($form_data["action"])&&$form_data["action"])?$form_data:$this->orm);
        if($this->render_type=="")
        {        
            // standardni vykresleni tabulky
            $this->template->admin_content = $this->auto_list_table->generate($this->orm, false);
        }elseif($this->render_type=="csv"){
            //export CSV
            $csv=$this->module_service->list_table_to_csv($this->auto_list_table->generate($this->orm));
            ob_get_clean();
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=\"export.csv\"");
            header("Content-Type: text/plain; charset=utf-8");
            echo($csv);
            exit;
 
        }elseif($this->render_type=="print"){
            // vystup na tiskarnu
            echo($this->auto_list_table->generate($this->orm));
            exit;
        }
        //$this->request->response=$this->template->render();

//        if(Request::$is_ajax)
//        {
//            // vystup do ajaxu
//            echo($this->auto_list_table->generate($orm));
//            return;
//        }else{
//            // standartni generovani
//            $this->template->admin_content=$this->auto_list_table->render($orm);
//        }

    }
    
    /////////////////////////////////////////////////////////////
    // nasleduji prepisovatelne metody jednotlivych fazi generovani tabulky

    protected function _table_options()
    {
        $this->auto_list_table->tree_mode = $this->tree_mode;


    }

    protected function _orm_setup()
    {

    }

    protected function _orm_preparation_all($where=false, $like=false)
    {

        if($where)
        {
            foreach($where as $item)
            {
                $this->orm->where($item[0],$item[1],$item[2]);
            }
        }
        
        if($this->tree_mode && $this->filtering_applied===false) $this->orm->where("parent_id","=",0);
        
        $db_cols=$this->orm->table_columns();
        if(isset($db_cols["smazano"])) $this->orm->where("smazano","=",0);
        
        if($like)
        {
            foreach($like as $item)
            {
                $this->orm->where($item[0],$item[1],$item[2]);
            }

        }
    }

     protected function _orm_preparation_list($order_by=false, $order_direction="ASC", $limit=false, $offset=0)
     {
        if($order_by)
        {
            $this->orm->order_by($order_by,$order_direction);
        }
        else
        {
            // definuju automaticky standardni razeni podle poradi, nebo nazvu - je li dostupny
            if($this->order_mode)
            {
                $this->orm->order_by("poradi","asc");
            }
            elseif($this->col_nazev)
            {
                $this->orm->order_by("nazev","asc");
            }
        }
        if($limit)
        {
            $this->orm = $this->orm->limit($limit)->offset($offset)->find_all();
        }else{
            $this->orm = $this->orm->find_all();
        }
    }
    
    protected function _get_next_item_id($order_by=false, $order_direction="ASC", $limit=false, $offset=0, $last_id=0)
     {
        //print_r($_SESSION["item_sequence"]);
        if(isset($_SESSION["item_sequence"]) && $last_id)
        {
            $sequence=$_SESSION["item_sequence"];
            
            $current=array_search($last_id, $sequence);
            
            if($current!==false && isset($sequence[$current+1])) return($sequence[$current+1]);
        }
        
        if(isset($last_id))
        {
            $this->item_page++;
            
            $this->_orm_preparation_list($order_by, $order_direction, $this->session->get("it_per_pg",30), ($this->item_page-1)*$this->session->get("it_per_pg",30));
            
            $_SESSION["item_sequence"]=array();
            foreach($this->orm as $sequence_item)
            {
                // vygenerovani nove sekvence
                $_SESSION["item_sequence"][]=$sequence_item->id;
                 
            }
            reset($_SESSION["item_sequence"]);
            return(current($_SESSION["item_sequence"]));
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
     */
    protected function _action_router($data)
    {
        $action=false;
        if(isset($data["hana_form_action"]))
        {
            $action=$data["hana_form_action"];
        }
        elseif(isset($_POST["hana_form_action"]) && is_array($_POST["hana_form_action"]))
        {
            $action=key($_POST["hana_form_action"]);
        }
        elseif(isset($_POST["hana_form_action"]))
        {
            $action=$_POST["hana_form_action"];
        }

        if($action)
        {
            $this->_form_action_default($data);
            $main_action = "_form_action_".$action;
            return $result = $this->$main_action($data);
        }

        return true;

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

    protected function _form_action_save($data)
    {

    }

    /**
     * Mazani polozky a pripojenych zdroju
     * @param array $data
     */
    protected function _form_action_delete($data)
    {

        if($this->module_service->delete($data["delete"],$this->with_route))
        {
            $this->data_saved="deleted";
            return true;
        }

        
    }

    /**
     * Provede zmenu viditelnosti nad danym objektem
     * @param array $data
     */
    protected function _form_action_change_visibility($data)
    {
        if($this->orm instanceof ORM_Language && $this->orm->is_join_on_routes())
        {
            $this->orm->find($data["id"]);
            $this->module_service->change_visibility($data["id"], $data["state_value"], $this->orm->route);
        }
        else
        {
            $this->module_service->change_visibility($data["id"], $data["state_value"]);
        }
        $this->data_saved=true;
    }

    protected function _form_action_change_order($data)
    {
        $this->module_service->reorder_two_items($data["item_id"], $data["direction"]);
        $this->data_saved=true;
    }

    protected function _form_action_drag_change_order($data)
    {     
        if($this->order_mode){ 
            $this->module_service->reorder_many_items($this->orm->table_name(),$data["sequence"], $this->tree_mode);
            $this->data_saved=true;  
         }
    }
}
?>