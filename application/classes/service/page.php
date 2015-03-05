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
    public static $navigation_module="page";
    public static $photos_subdir = array( // index is $page_category in page's edit controller (db: pages.page_category_id)
		3 =>'/item/gallery/',
		4 =>'/secondary/gallery/',
    );
    
    public static $slideshows_subdir = array( // index is $page_category in page's edit controller (db: pages.page_category_id)
		3 =>'/item/slideshow/',
		4 =>'/secondary/slideshow/',
    );
    
    public static function get_page_photos($page_id, $thumbs = array(), $page_category_id = 3)
    {
        $photos = orm::factory("page_photo")
					->where("page_id","=",$page_id)
					->where("zobrazit","=",1)
					->language(0)
					->order_by("poradi","asc")
					->find_all();

        $dirname = self::$photos_resources_dir . self::$navigation_module . self::$photos_subdir[$page_category_id] . 'images-' . $page_id;
        $result = array();

        foreach($photos as $photo)
        {
			$result[]['name'] = $photo->nazev;
			end($result);
			$last_id = key($result);
            $result[$last_id]['description'] = $photo->popis;
            $result[$last_id]['nazev_seo'] = $photo->popis;

            if (empty($thumbs))
            {
                $result[$last_id]["photo"] = url::base() . $dirname . '/' . $photo->photo_src . '-ad.jpg';
            }
          
			foreach ($thumbs as $key => $thumb) {
				$thumbKey = is_int($key) ? $thumb : $key;
				$thumb_path = str_replace('\\', '/', DOCROOT) . $dirname . '/' . $photo->photo_src . '-' . $thumbKey . '.jpg';
				
				if($photo->photo_src && file_exists($thumb_path)) {
					$result[$last_id]["photo_$thumb"] = url::base() . $dirname . '/' . $photo->photo_src . '-' . $thumbKey . '.jpg';
				}
			}
        }

        return $result;
    }
    
    public static function get_pages_with_parent($language_id,$parent_id,$limit = 3)
    {
        $result_data = array();

        $nodes = orm::factory("page")
                    ->where("parent_id","=",$parent_id)
                    ->where("language_id","=",$language_id)
                    ->limit($limit)
                    ->find_all();

        foreach($nodes as $node){
            $result_data[$node->id] = $node->as_array();
            $dirname = self::$photos_resources_dir . self::$navigation_module. '/item/images-' . $node->id.'/';
            
            if($node->icon_src && file_exists( str_replace('\\', '/', DOCROOT) . $dirname . $node->icon_src . '-t1.png')){
                $result_data[$node->id]['icon'] =url::base(). $dirname . $node->icon_src . '-t1.png';
            } else {
                $result_data[$node->id]['icon'] = "";
            }
        }

        return $result_data;
    }
}
?>
