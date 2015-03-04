<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Service_Hana_Module_Base implements Interface_Navigable, Interface_Searchable
{
    protected static $navigation_module;
    protected static $chainable=false; // modul ma stromovou strukturu
    protected static $order_by="poradi";
    protected static $order_direction="asc";
    
    /**
     * Metoda na vygenerovani navigace struktury
     * @param type $language_id jazykova verze
     * @param type $breadcrumbs aktualni cesta (vygeneruje pouze vetve, ktere jsou v ramci retezce zvolene cesty)
     * @param type $category kategorie navigace 
     * @param type $max_levels hloubka navigace - false=nekonecno 
     */
    public static function get_navigation($language_id,$category=0,$max_levels=false,$breadcrumbs=array())
    {
        $module=static::$navigation_module;
        $result_data=array();
          $nodes = DB::select($module."_data.nazev","routes.nazev_seo","routes.language_id",$module."s.id")
                ->from($module."s")
                ->join($module."_data")->on($module."s.id","=",$module."_data.".$module."_id")
                ->join("routes")->on($module."_data.route_id","=","routes.id")
                ->where($module."s.".$module."_category_id","=",db::expr($category))
                ->where("routes.language_id","=",DB::expr($language_id))
                ->where("routes.zobrazit","=",1)
                ->where("routes.deleted","=",0)
                ->order_by(static::$order_by,static::$order_direction)
                ->as_object()->execute();
          foreach($nodes as $node)
          {
              $result_data[$node->nazev_seo]=(array)$node; 
          }

          return $result_data;
    }
    
    /**
     * Vrati jeden segment retezce drobitkove navigace dle seo_nazvu.
     * @param type $nazev_seo
     * @return array 
     */
    public static function get_navigation_breadcrumb($nazev_seo)
    {
        $module=static::$navigation_module;
        $result_data = DB::select($module."_data.nazev","routes.nazev_seo","routes.language_id");
        
        if(static::$chainable)
        {
           $result_data->select($module."s.parent_id"); 
        }
        
        $result_data =  $result_data->from($module."s")
                ->join($module."_data")->on($module."s.id","=",$module."_data.".$module."_id")
                ->join("routes")->on($module."_data.route_id","=","routes.id")
                ->where("routes.nazev_seo","=",$nazev_seo)
                ->where("routes.zobrazit","=",1)
                ->execute()->as_array();
        
        //die(print_r($result_data[0]));
        if(isset($result_data[0]))
        {
            $result_data=$result_data[0];
            $result_data["parent_nazev_seo"]="";
            $result_data["breadcrumbs_end"]=false;
            
            if(static::$chainable && isset($result_data["parent_id"]) && $result_data["parent_id"]>0)
            {
                // nadrazena v tree modulu
                    $parent=DB::select("nazev_seo")
                    ->from($module."_data")
                    ->join("routes")->on($module."_data.route_id","=","routes.id")->on("routes.language_id","=",DB::expr($result_data["language_id"]))
                    ->where($module."_data.".$module."_id","=",$result_data["parent_id"])
                    ->execute()->as_array();
                    if(isset($parent[0]["nazev_seo"])) $result_data["parent_nazev_seo"]=$parent[0]["nazev_seo"]; else $result_data["parent_nazev_seo"]="";

            }
            else
            {
                // hlavni modulova
                
                $result_data["parent_nazev_seo"]=DB::select("routes.nazev_seo")->from("routes")->join("modules")->on("routes.module_id","=","modules.id")->where("modules.kod","=",$module)->where("routes.module_action","=","index")->where("routes.language_id","=",$result_data["language_id"])->where("routes.zobrazit","=",1)->where("routes.deleted","=",0)->execute()->get("nazev_seo");        
                $result_data["breadcrumbs_end"]=true;
            }
            
            if($nazev_seo==$result_data["parent_nazev_seo"]) $result_data["parent_nazev_seo"]="";
            return($result_data);
        }
        else
        {
            return array();
        }
        
        
    }
    
    /**
     * Vrati celou cestu drobitkove navigace dle koncoveho sea.
     * @param type $nazev_seo 
     */
    public static function get_navigation_breadcrumbs($nazev_seo)
    {
        $breadcrumbs=array();
        do
        {
            $breadcrumb=static::get_navigation_breadcrumb($nazev_seo);
            $breadcrumbs[$nazev_seo]=$breadcrumb;
            $nazev_seo=isset($breadcrumbs[$nazev_seo]["parent_nazev_seo"])?$breadcrumbs[$nazev_seo]["parent_nazev_seo"]:"";
            if(isset($breadcrumb["breadcrumbs_end"]) && $breadcrumb["breadcrumbs_end"]===true) $nazev_seo="";
        }
        while($nazev_seo);
        return($breadcrumbs); 
    }
    
    /*
     * Konfigurace vyhledávání v modulu. Urceno k predefinovani v odvozenych servisach.
     */
    public static function search_config()
    {
        return array(); 
    }
  
}

?>
