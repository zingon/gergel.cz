<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Servisa pro obsluhu vyhledavani.
 *
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Service_Hana_Search extends Service_Hana_Module_Base
{
    public static $navigation_module="page";
    protected static $chainable=true;
    
    /**
     * Zrychlene vyhledavani (pouzito pro ajaxovy naseptavac) podle nazvu
     * @param string $search_str 
     */
    public static function quick_search($search_str, $language_id=1)
    {
        $names=DB::select("title","nazev_seo")->from("routes")->where("title","LIKE","%".$search_str."%")->where("language_id","=",$language_id)->where("zobrazit","=",1)->where("deleted","=",0)->where("internal","=",0)->where("searcheable","=",1)->order_by("title","ASC")->execute()->as_array();
        $result_array=array();
        foreach ($names as $item){$result_array[]=array("url"=>$item["nazev_seo"],"name"=>$item["title"]);}
        return $result_array;
    }
    
    /**
     *
     * @param type $search_array
     * @param type $language_id 
     */
    public static function search($search_str, $language_id=1)
    {
        $search_modules = Service_Search::setup_search();

        $modules_configuration=array();
        
        foreach ($search_modules as $module)
        {
            $module_service="Service_".ucfirst($module);
            $module_search_config=$module_service::search_config();
            if(!empty($module_search_config))
            {
                $modules_configuration[$module]=$module_search_config;
            }
        }
        
    
//        "product"=>array(
//                  "title"=>"produkty",
//                  "language"=>true,
//                  "display_title"=>"product_data.nadpis",
//                  "display_text"=>"product_data.uvodni_popis",
//                  "search_columns"=>array("product_data.nazev", "product_data.uvodni_popis", "product_data.popis")
//              ),
        
        

        $search_results=array();

        foreach($modules_configuration as $title=>$search_module)
        {
            $table_plural=Inflector::plural($title);
            $x=1;
            $query = DB::select(array($table_plural.'.id', 'id'), array($search_module["display_title"],"title"),array($search_module["display_text"],"text"),array("routes.nazev_seo","nazev_seo"))
                        ->from($table_plural)
                        ->join($title."_data")->on($table_plural.".id","=",$title."_data.".$title."_id")
                        ->join("routes")->on($title."_data.route_id","=","routes.id")
                        ->where("routes.language_id","=",$language_id)
                        ->where("routes.zobrazit","=",1)->where("routes.deleted","=",0)->where("routes.internal","=",0);

            $query->and_where_open();


            foreach($search_module["search_columns"] as $search_item)
            {
                $query->or_where($search_item,"like","%".$search_str."%");
            }
            $query->and_where_close();
            $result = $query->execute()->as_array();

            foreach($result as $res)
            {
                $search_results[$search_module["title"]][$x]["title"]=$res["title"];
                $search_results[$search_module["title"]][$x]["text"]=$res["text"];
                $search_results[$search_module["title"]][$x]["nazev_seo"]=$res["nazev_seo"];
                if ($title == "product_category")
                {
                    $search_results[$search_module["title"]][$x]["template"]=Service_Catalog_Category::get_parents_template($res["id"]);
                }
                $x++;
            }

        }

        return($search_results);
    }
    
    /**
     * Seznam modulu ve kterych se bude vyhledavat.
     */
    public static function setup_search(){return array();} // return array("page","article","product");
    
}
?>
