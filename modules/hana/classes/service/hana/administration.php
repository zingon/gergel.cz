<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Servisni trida pro obsluhu zakladnich funkci administracni casti.
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class Service_Hana_Administration
{

    private static $cache_enabled=true;

    private static $menu_L1_sel;
    private static $menu_L2_enabled=false;
    private static $menu_L2_sel;
    private static $menu_L3_enabled=false;
    private static $menu_L3_sel;

   
    public static function get_main_navigation_links($module, $submodule, $controller, $language_id = 1)
    {

        // otestuju L3, pripadne urcim vsecky rodice
        self::$menu_L3_sel = DB::select("id","parent_id")->from("admin_structure")->where("admin_menu_section_id","=",3)->where("module_code","=",$module)->where("submodule_code","=",$submodule)->where("module_controller","=",$controller)->execute()->as_array();
        if(empty(self::$menu_L3_sel))
        {
            self::$menu_L3_sel = DB::select("id","parent_id")->from("admin_structure")->where("admin_menu_section_id","=",3)->where("module_code","=",$module)->where("submodule_code","=",$submodule)->execute()->as_array();
        }

        // otestuju L2 a urcim rodice
        if(empty(self::$menu_L3_sel))
        {
            self::$menu_L2_sel = DB::select("id","parent_id")->from("admin_structure")->where("admin_menu_section_id","=",2)->where("module_code","=",$module)->where("submodule_code","=",$submodule)->where("module_controller","=",$controller)->execute()->as_array();
            if(empty(self::$menu_L2_sel))
            {
                self::$menu_L2_sel = DB::select("id","parent_id")->from("admin_structure")->where("admin_menu_section_id","=",2)->where("module_code","=",$module)->where("submodule_code","=",$submodule)->execute()->as_array();
            }
        }
        else
        {
            self::$menu_L2_sel = DB::select("id","parent_id")->from("admin_structure")->where("admin_menu_section_id","=",2)->where("id","=",self::$menu_L3_sel[0]["parent_id"])->execute()->as_array();
        }

        // zvolim polozku v L1
        if(empty(self::$menu_L3_sel) && empty(self::$menu_L2_sel))
        {
            self::$menu_L1_sel = DB::select("id")->from("admin_structure")->where("parent_id","=",0)->where("module_code","=",$module)->where("submodule_code","=",$submodule)->where("module_controller","=",$controller)->execute()->as_array();
            if(empty(self::$menu_L1_sel)) // zkusim zvolit polozku ze stejneho submodulu
            {
                self::$menu_L1_sel = DB::select("id")->from("admin_structure")->where("parent_id","=",0)->where("module_code","=",$module)->where("submodule_code","=",$submodule)->execute()->as_array();
            }
        }
        elseif(!empty(self::$menu_L2_sel))
        {
            self::$menu_L1_sel = DB::select("id")->from("admin_structure")->where("parent_id","=",0)->where("id","=",self::$menu_L2_sel[0]["parent_id"])->execute()->as_array();
        }
        else
        {
             self::$menu_L1_sel = DB::select("id")->from("admin_structure")->where("parent_id","=",0)->where("id","=",self::$menu_L3_sel[0]["parent_id"])->execute()->as_array();
        }


        // test
        //echo("L3:".print_r(self::$menu_L3_sel)." L2:".print_r(self::$menu_L2_sel)." L1:".print_r(self::$menu_L1_sel));

        $links=orm::factory("admin_structure")->where("zobrazit","=",1)->order_by("poradi","asc")->where("parent_id","=",0)->find_all();
        $result_array=array();
        foreach($links as $link)
        {
           $result_array[$link->id]["nazev"]=$link->nazev;
           $result_array[$link->id]["href"]=url::base().Kohana::$index_file."admin/".$link->module_code."/".$link->submodule_code."/".$link->module_controller;
           $result_array[$link->id]["global_access_level"]=$link->global_access_level;
           if($link->id==self::$menu_L1_sel[0]["id"]) $result_array[$link->id]["sel"]="sel";

        }
        
        return $result_array;
    }

    public static function get_subnavigation_links()
    {
        $parent_id=self::$menu_L1_sel[0]["id"];
        $links=orm::factory("admin_structure")->where("zobrazit","=",1)->order_by("poradi","asc")->where("parent_id","=",$parent_id)->where("admin_menu_section_id","=",2)->find_all();
        $result_array=array();
        foreach($links as $link)
        {
           $result_array[$link->id]["nazev"]=$link->nazev;
           $result_array[$link->id]["href"]=url::base().Kohana::$index_file."admin/".$link->module_code."/".$link->submodule_code."/".$link->module_controller;
           $result_array[$link->id]["global_access_level"]=$link->global_access_level;
           if(isset(self::$menu_L2_sel[0]) && $link->id==self::$menu_L2_sel[0]["id"]) $result_array[$link->id]["sel"]="sel";

        }

        return $result_array;
    }

    public static function get_module_links($language_id = 1)
    {
        $parent_id=(isset(self::$menu_L2_sel[0]["id"]))?self::$menu_L2_sel[0]["id"]:self::$menu_L1_sel[0]["id"];
        $links=orm::factory("admin_structure")
            ->where("zobrazit","=",1)
            ->order_by("poradi","asc")
            ->where("parent_id","=",$parent_id)
            ->where("admin_menu_section_id","=",3)
            ->language($language_id)
            ->find_all();

        $languages = Kohana::config('languages');
        $language_code = $languages["mapping"][$language_id];

        $result_array=array();
        foreach($links as $link)
        {
           if($link->id)
           {
               $result_array[$link->id]["nazev"]=$link->nazev;
               $result_array[$link->id]["pristup"]=$link->global_access_level;
               $result_array[$link->id]["href"]=url::base().Kohana::$index_file."admin/".$language_code."/".$link->module_code."/".$link->submodule_code."/".$link->module_controller;
               $result_array[$link->id]["global_access_level"]=$link->global_access_level;
               if(isset(self::$menu_L3_sel[0]) && isset(self::$menu_L3_sel[0]["id"]) && $link->id==self::$menu_L3_sel[0]["id"]) $result_array[$link->id]["sel"]="sel";
           }
        }
        return $result_array;
    }
    
    /* Může být rekurzivně, ale vzhledem k tomu, že slouží k vyzvednutí pouze kategorie a jedné podkategorie je to zbytečné */
    
    public static function get_main_navigation_links_sublinks($language_id = 1)
    {
        $nav_items = array();
        
        $levels_1 = orm::factory("admin_structure")
            ->where("zobrazit","=",1)
            ->where("admin_menu_section_id","=",1)
            ->language($language_id)
            ->order_by("poradi","asc")
            ->find_all();


        $languages = Kohana::config('languages');
        $language_code = $languages["mapping"][$language_id];

        $index = 0;
        foreach ($levels_1 as $level_1)
        {
            
            $nav_items[$index]["id"] = $level_1->id;
            $nav_items[$index]["nazev"] = $level_1->nazev;
            $nav_items[$index]["global_access_level"] = $level_1->global_access_level;
            $nav_items[$index]["has_childs"] = false;
            $nav_items[$index]["href"] = url::base().Kohana::$index_file."admin/".$language_code."/".$level_1->module_code."/".$level_1->submodule_code."/".$level_1->module_controller;
            if($level_1->id==self::$menu_L1_sel[0]["id"]) $nav_items[$index]["sel"]="sel";

            $levels_2 = orm::factory("admin_structure")
                ->where("zobrazit","=",1)
                ->where("admin_menu_section_id","=",2)
                ->where("parent_id","=",$level_1->id)
                ->order_by("poradi","asc")
                ->find_all();
            
            if (count($levels_2) > 0)
            {
                $nav_items[$index]["has_childs"] = true;
                $index_2 = 0;
                foreach ($levels_2 as $level_2)
                {
                    $nav_items[$index]["childs"][$index_2]["id"] = $level_2->id;
                    $nav_items[$index]["childs"][$index_2]["nazev"] = $level_2->nazev;
                    $nav_items[$index]["childs"][$index_2]["global_access_level"] = $level_2->global_access_level;
                    $nav_items[$index]["childs"][$index_2]["href"] = url::base().Kohana::$index_file."admin/".$language_code."/".$level_2->module_code."/".$level_2->submodule_code."/".$level_2->module_controller;
                    if(isset(self::$menu_L2_sel[0]) && $level_2->id==self::$menu_L2_sel[0]["id"]) $nav_items[$index]["childs"][$index_2]["sel"]="sel";
                    $index_2++;
                }
            }
            $index++;
        }
        
        return $nav_items;
            
    }
}
?>
