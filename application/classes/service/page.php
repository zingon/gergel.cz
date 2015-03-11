<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Servisa pro obsluhu statickych stranek.
 *
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Service_Page extends Service_Hana_Page
{
    
    
    public static function get_pages_with_parent($language_id,$parent_id,$limit = 3)
    {
        $result_data = array();

        $nodes = orm::factory("page")
                    ->join('routes')->on("page_data.route_id","=","routes.id")
                    ->where("parent_id","=",$parent_id)
                    ->where("language_id","=",$language_id)
                    ->limit($limit)
                    ->find_all();

        foreach($nodes as $node){
            $result_data[$node->id] = $node->as_array();
            $result_data[$node->id]['nazev_seo'] = $node->nazev_seo;
            $dirname = self::$photos_resources_dir . self::$navigation_module. '/item/images-' . $node->id.'/';
            
            if($node->icon_src && file_exists( str_replace('\\', '/', DOCROOT) . $dirname . $node->icon_src . '-t1.png')){
                $result_data[$node->id]['icon'] =url::base(). $dirname . $node->icon_src . '-t1.png';
            } else {
                $result_data[$node->id]['icon'] = "";
            }
        }

        return $result_data;
    }

    protected static function get_photos($language_id,$module_id,$thumbs = array(),$module="page",$dir="/media/photos") {
        
    }
}
?>
