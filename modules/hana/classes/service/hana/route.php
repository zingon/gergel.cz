<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Service_Hana_Route
{

    /**
     * Nacte routu z DB
     * @param string $nazev_seo
     * @return orm
     */
    public static function get_page_route_by_nazev_seo($nazev_seo)
    {
        return orm::factory("route")->where("nazev_seo","=",$nazev_seo)->find();
    }


    public static function get_actual_nazev_seo()
    {
        return Request::instance()->param("id1");
    }

    public static function get_route_parameter()
    {
        return Request::instance()->param("id2");
    }

    public static function get_route_parameter_2()
    {
        return Request::instance()->param("id3");
    }
    
    /**
     * Ulozi naplnene ORM routy 
     * Melo by predchazet vytvoreni ORM objektu routy, naplneni daty a zavolani metody check() k overeni spravnosti zadanych dat 
     * @param type $route_orm ORM routy
     * 
     */
    
    /**
     * Ulozi naplnene ORM routy
     * Melo by predchazet vytvoreni ORM objektu routy, naplneni daty a zavolani metody check() k overeni spravnosti zadanych dat
     * (na zaklade $subject_id - zakladni nejazykove id (napr hodnota product.id) $class_name (napr "product") a $language_class_name (napr. product_data) se automaticky vygeneruje baselang_route_id (jinak nutno dodat)  
     * @param type $route_orm ORM routy
     * @param int $subject_id
     * @param string $class_name
     * @param string $language_class_name
     * @return orm/false vraci aktualni ulozeny route orm, nebo false (pokud se ulozeni nezdarilo) 
     */
    public static function save_route($route_orm, $subject_id=null, $class_name="", $language_class_name="")
    {
        if(!$route_orm->check()) return false;
        
        if(!$route_orm->id) 
        {
            $route_orm->created_date=DB::expr("NOW()");
            
            // ulozeni baselang_id - seskupeni souvisejicich rout
            if($subject_id && $class_name && $language_class_name)
            {  
                $route_orm->baselang_route_id=DB::select(array("routes.id","id"))->from($language_class_name)->join("routes")->on($language_class_name.".route_id","=","routes.id")->where($language_class_name.".".$class_name."_id","=",$subject_id)->where($language_class_name.".language_id","=",1)->as_object()->execute()->current()->id;
            }
        }
        else
        {
            $route_orm->updated_date=DB::expr("NOW()");
        }

        

        
        return $route_orm->save();   
    }
    
    /**
     * Provede smazani routy - nastaveni priznaku v DB na smazano (vsech 
     * @param id/orm $route_id - id, nebo orm routy ke smazani
     * @param boolean $all_languages priznak, zda smazat vsechny souvisejici jazykove routy
     */
    public static function delete_route($route, $all_languages=true)
    {
        if(is_int($route) || is_string($route))
        {
            $route = orm::factory("route")->where("id","=",$route)->find(); 
        }
        
        $baselang_route_id=$route->id;
        
        self::_perform_delete_route($route);
        
        if($all_languages)
        {
            $routes_to_delete = orm::factory("route")->where("baselang_route_id","=",$baselang_route_id)->find_all();
            
            foreach($routes_to_delete as $kill_route)
            {
                self::_perform_delete_route($kill_route);
            }
        }
        
        
    }
    
    private static function _perform_delete_route($route)
    {
        $route->deleted=1;
        $route->zobrazit=0;
        $route->nazev_seo_old=$route->nazev_seo;
        $route->deleted_date=DB::expr("NOW()");//date("d-m-Y H:i:s");
        $route->nazev_seo=$route->nazev_seo."-deleted-".date("d-m-Y(H:i:s)");
        $route->save();
    }
    
    public static function update_route()
    {
        
    }
    
    /**
     * Vrati mnozinu odkazu na stejnou stranku
     * @param type $route_id 
     */
    public static function get_baselang_links_group(Model_Route $route)
    {
        $baselang_route_id=$route->baselang_route_id;
        
        $result_array=array();
        
        $lang_array = Kohana::$config->load('languages')->get("mapping");
        
        if($baselang_route_id==0)
        {
            $result_array[$lang_array[$route->language_id]]=$route->nazev_seo;
            $result=DB::select("language_id","nazev_seo")->from("routes")->where("baselang_route_id","=",$route->id)->where("zobrazit","=",1)->where("deleted","=",0)->as_object()->execute();
            foreach($result as $row)
            {
                $result_array[$lang_array[$row->language_id]]=$row->nazev_seo;

            }

        }
        else
        {
            $result1=DB::select("language_id","nazev_seo")->from("routes")->where("id","=",$baselang_route_id)->as_object()->execute()->current();
            $result_array[$lang_array[$result1->language_id]]=$result1->nazev_seo;
            $result_array[$lang_array[$route->language_id]]=$route->nazev_seo;
            $result2=DB::select("language_id","nazev_seo")->from("routes")->where("baselang_route_id","=",$baselang_route_id)->where("zobrazit","=",1)->where("deleted","=",0)->as_object()->execute();
            foreach($result2 as $row)
            {
                $result_array[$lang_array[$row->language_id]]=$row->nazev_seo;
            } 
        }
        return $result_array; 
    }
    
    public static function get_language_index_seo($language_id)
    {
        if($language_id==1) return ""; else
        return db::select("nazev_seo")->from("routes")->where("baselang_route_id","=",db::expr("(SELECT id FROM routes WHERE nazev_seo=\"index\")"))->where("language_id","=",(int)$language_id)->execute()->get("nazev_seo");
        
    }

    

//    public function get_selected_language_id() {
//        return $this->selected_language_id?$this->selected_language_id:1;
//
//    }
//
//    public function set_selected_language_id($selected_language_id=1) {
//        $this->selected_language_id = (int) $selected_language_id;
//        if($this->selected_language_id==0 && Cookie::get("last_language_id")){
//            $this->selected_language_id=Cookie::get("last_language_id");
//        }elseif($this->selected_language_id==0){
//            $this->selected_language_id=1;
//        }
//        i18n::lang($this->languages_map[$this->selected_language_id]);
//        
//        // pro ucely zobrazeni 404ky a jinych stranek, ze kterych nezjistim jaz verzi, si posledni zvolenou jaz verzi ulozim do cookie
//        Cookie::set("last_language_id", $this->selected_language_id);
//    }
//
//    public function get_last_language_id()
//    {
//        if($llid=Cookie::get("last_language_id")) return $llid;
//        else
//        $llid = array_search($_SERVER["HTTP_ACCEPT_LANGUAGE"], $this->languages_map);
//
//        if($llid) return $llid; else return 1;
//    }
//
//    public function get_selected_language_code() {
//        return $this->languages_map[$this->get_selected_language_id()];
//    }
   
    
    
    public static function get_self_URL(){ if(!isset($_SERVER['REQUEST_URI'])){ $serverrequri = $_SERVER['PHP_SELF']; }else{ $serverrequri = $_SERVER['REQUEST_URI']; } $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; $protocol = self::strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); return $protocol."://".$_SERVER['SERVER_NAME'].$port.$serverrequri; }
   
    private static function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
    
    
}
?>
