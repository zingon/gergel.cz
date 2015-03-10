<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Servisa pro obsluhu statickych stranek.
 *
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Service_Hana_Page extends Service_Hana_Module_Base
{
    public static $photos_resources_dir="media/photos/";
    public static $navigation_module="page";
    protected static $chainable=true;
    
    /**
     * Nacte stranku dle route_id
     * @param int $id
     * @return orm 
     */
    public static function get_page_by_route_id($id)
    {
        $page_orm= orm::factory("page")->where("route_id","=",$id)->find();
        if($page_orm->direct_to_sublink)
        {
            $language_id=  Hana_Application::instance()->get_actual_language_id();
            //throw new Kohana_Exception("Požadovaná stránka nebyla nalezena", array(), "404");
            $first_subpage_seo=DB::select("routes.nazev_seo")
                ->from("pages")
                ->join("page_data")->on("pages.id","=","page_data.page_id")
                ->join("routes")->on("page_data.route_id","=","routes.id")
                ->where("pages.parent_id","=",db::expr($page_orm->id))
                ->where("routes.language_id","=",DB::expr($language_id))
                ->where("routes.zobrazit","=",DB::expr(1))
                ->order_by("poradi")
                ->limit(1)
                ->execute()->get("nazev_seo");
            Request::instance()->redirect(url::base().$first_subpage_seo);
        }
        
        $result_data=$page_orm->as_array();
        
        // cesta k obrazku
        $dirname=self::$photos_resources_dir."page/item/images-".$page_orm->id."/";
        

        if($page_orm->photo_src && file_exists(str_replace('\\', '/',DOCROOT).$dirname.$page_orm->photo_src."-t1.jpg"))
        {
            $result_data["photo_detail"]=url::base().$dirname.$page_orm->photo_src."-t1.jpg";
        }
        
        return $result_data;
    }
    
    /**
     * Najde podřízené stránky. 
     * @param type $page_id
     * @return orm  
     */
    public static function get_page_index($page_id)
    {
        $language_id=  Hana_Application::instance()->get_actual_language_id();
        $index_pages=DB::select("pages.photo_src")->select("pages.id")->select("page_data.nazev")->select("page_data.uvodni_popis")->select("page_data.akce_text")->select("routes.nazev_seo")
                ->from("pages")
                ->join("page_data")->on("pages.id","=","page_data.page_id")
                ->join("routes")->on("page_data.route_id","=","routes.id")
                ->where("pages.parent_id","=",db::expr($page_id))
                ->where("routes.language_id","=",DB::expr($language_id))
                ->where("routes.zobrazit","=",DB::expr(1))     
                ->order_by("poradi")
                ->execute();
        
        $index_pages=$index_pages->as_array();
        $result_data=array();
        
        foreach ($index_pages as $page)
        {
            $result_data[$page["nazev"]]["nazev"]=$page["nazev"];
            $result_data[$page["nazev"]]["nazev_seo"]=$page["nazev_seo"];
            $result_data[$page["nazev"]]["uvodni_popis"]=$page["uvodni_popis"];
            $result_data[$page["nazev"]]["akce_text"]=$page["akce_text"];
            
            $dirname=self::$photos_resources_dir."page/item/images-".$page["id"]."/";
            if($page["photo_src"] && file_exists(str_replace('\\', '/',DOCROOT).$dirname.$page["photo_src"]."-t2.jpg"))
            {
                $result_data[$page["nazev"]]["photo_detail"]=url::base().$dirname.$page["photo_src"]."-t2.jpg";
            }
        }
        
        
        return $result_data;
    }
    
    
    /**
     * 
     * @param type $code
     * @param type $language_id
     * @return type 
     */
    public static function get_static_content_by_code($code, $language_id=1)
    {
        return orm::factory("static_content")->where("kod","=",$code)->where("language_id","=",$language_id)->find();
    }
    
    public static function search_config()
    {
        return array(

                  "title"=>"Výsledky ve stránkách",
                  "display_title"=>"page_data.nazev",
                  "display_text"=>"page_data.uvodni_popis",
                  "search_columns"=>array("page_data.nazev", "page_data.popis", "page_data.uvodni_popis"),
//                  "display_category_title"=>"product_category_data.nazev",
//                  "display_category_text"=>"product_category_data.uvodni_popis",
//                  "search_category_columns"=>array("product_category_data.nazev", "product_category_data.uvodni_popis", "product_category_data.popis")
              
        );
    }
    
}
?>
