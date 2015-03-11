<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Servisa pro obsluhu katalogu kategorii produktu.
 *
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Service_Catalog_Category implements Interface_Searchable 
{
    public static $photos_resources_dir="media/photos/";
    public static $files_resources_dir="media/files/";
    
    public static $default_order_by="price";
    public static $default_order_direction="asc";
    
    
    public static function get_product_category_by_route_id($route_id, $allow_products = true)
    {
        // ziskani kategorie
        $category=orm::factory("catalog_category")->where("product_category_data.route_id","=",$route_id)->order_by("poradi","ASC");
        $category->where("zobrazit","=",1);
        $category=$category->find();

        // Generovani vypisu produktu
        $category_data=array();
        $category_data=$category->as_array();
        $category_data["children"] = ($category->show_prod && $allow_products) ? Service_Product::get_products_by_cat_id($category->id, $category->language_id) : self::get_categories_by_parent_id($category->id, $category->language_id);


        return $category_data;
    }

    public static function get_category_by_nazev_seo($nazev_seo)
    {
        $route = ORM::factory("route")
            ->where("nazev_seo", "=", $nazev_seo)
            ->find();

        return ORM::factory("product_category")
            ->where("route_id", "=", $route->id)
            ->find();
    }

    public static function get_categories_by_parent_id($parent_id, $language_id = 0, $levels = 1, $limit = 0)
    {
        $levels--;
        $return = array();

        $categories = ORM::factory("catalog_category")
            ->where("parent_id", "=", $parent_id)
            ->language($language_id)
            ->where("zobrazit", "=", 1)
            ->order_by("poradi");
        if ($limit > 0)
            $categories->limit($limit);
        $categories = $categories->find_all();

        $i = 0;
        foreach ($categories as $cat)
        {
            $return[$i] = $cat->as_array();
            $return[$i]["nazev_seo"] = $cat->route->nazev_seo;

            if ($levels > 0)
            {
                $return[$i]["children"] = self::get_categories_by_parent_id($cat->id, $cat->language_id, $levels);
            }

            

            $dirname=self::$photos_resources_dir."catalog/category/images-".$cat->id."/";
            $return[$i]["photo_detail"]="";
            if($cat->photo_src && file_exists(str_replace('\\', '/',DOCROOT).$dirname.$cat->photo_src."-t1.png"))
            {
                $return[$i]["photo_detail"]=url::base().$dirname.$cat->photo_src."-t1.png";
            }
            $i++;
        }

        return $return;
    }
    
    public static function get_product_categories_by_parent_category_id($parent_id)
    {
        // ziskani kategorie
        $categories=orm::factory("product_category")->where("product_categories.parent_id","=",$parent_id)->order_by("poradi","ASC");
        $categories->where("zobrazit","=",1);
        $categories=$categories->find_all();
        
        $category_data=array();
        
        foreach ($categories as $category)
        {
            $category_data[$category->id]=$category->as_array();
            $category_data[$category->id]["nazev_seo"]=$category->route->nazev_seo;
            
            
            $dirname=self::$photos_resources_dir."catalog/category/images-".$category->id."/";

            if($category->photo_src && file_exists(str_replace('\\', '/',DOCROOT).$dirname.$category->photo_src."-t3.jpg"))
            {
                $category_data[$category->id]["photo_detail"]=url::base().$dirname.$category->photo_src."-t3.jpg";
            } 
        }
        // Generovani vypisu produktu      
        
        return $category_data;
    }
    
    public static function get_for_homepage($limit = 0, $language_id = 0)
    {
        $return = array();
        $products = ORM::factory("catalog_category")
            ->join('routes')->on('product_category_data.route_id', '=', 'routes.id')
            ->language($language_id)
            ->where('homepage', '=', 1)
            ->where('routes.zobrazit', '=', 1);
        if ($limit > 0)
            $products->limit($limit);
        $products = $products->find_all();

        $i = 0;
        foreach ($products as $product)
        {
            $return[$i] = $product->as_array();
            $return[$i]["nazev_seo"] = $product->route->nazev_seo;
            $i++;
        }

        return $return;
    }
    
    public static function get_navigation_category_breadcrumb($nazev_seo)
    {
        $result_data = DB::select("product_category_data.nazev", "product_categories.template","routes.nazev_seo","routes.language_id","product_categories.parent_id")
                ->from("product_categories")
                ->join("product_category_data")->on("product_categories.id","=","product_category_data.product_category_id")
                ->join("routes")->on("product_category_data.route_id","=","routes.id")
                ->where("routes.nazev_seo","=",$nazev_seo)
                //->where("routes.zobrazit","=",DB::expr(1))
                ->execute()->as_array();
        
        if(isset($result_data[0]))
        {
            $result_data=$result_data[0];
            $result_data["parent_nazev_seo"]="";
            if($result_data["parent_id"]>0)
            {
                    $parent=DB::select("nazev_seo")
                    ->from("product_category_data")
                    ->join("routes")->on("product_category_data.route_id","=","routes.id")->on("routes.language_id","=",DB::expr($result_data["language_id"]))
                    ->where("product_category_data.product_category_id","=",$result_data["parent_id"])
                    ->execute()->as_array();
            $result_data["parent_nazev_seo"]=$parent[0]["nazev_seo"];
            }
        
            return($result_data);
        }
        else
        {
            return array();
        }
  
    }

    public static function get_header_categories($max_items, $language_id = 0)
    {
        $return = array();
        $categories = ORM::factory("catalog_category")
            ->language($language_id)
            ->limit($max_items)
            ->join("routes")->on("routes.id", "=", "product_category_data.route_id")
            ->where("routes.zobrazit", "=", 1)
            ->where("header", "=", 1)
            ->order_by("poradi")
            ->find_all();

        $i = 0;
        foreach ($categories as $cat)
        {
            $return[$i]["nazev"] = $cat->nazev;
            $return[$i]["nazev_seo"] = $cat->route->nazev_seo;
            $i++;
        }

        return $return;
    }

    public static function get_header_products($max_items, $language_id = 0)
    {
        $return = array();
        $products = ORM::factory("product")
            ->language($language_id)
            ->limit($max_items)
            ->join("routes")->on("routes.id", "=", "product_data.route_id")
            ->where("routes.zobrazit", "=", 1)
            ->where("header", "=", 1)
            ->order_by("poradi")
            ->find_all();

        $i = 0;
        foreach ($products as $pro)
        {
            $return[$i]["nazev"] = $pro->nazev;
            $return[$i]["nazev_seo"] = $pro->route->nazev_seo;
            $i++;
        }

        return $return;
    }

    public static function get_parents_template($id, $language_id = 0)
    {
        $return = array();
        $cat = ORM::factory("product_category", $id);
        if ($cat->parent_id != 0)
        {
            $parent = ORM::factory("product_category")
                ->where("product_categories.id", "=", $cat->parent_id)
                ->language($language_id)
                ->find();
            $return["template"] = $parent->template;
            $return["nazev_seo"] = $parent->route->nazev_seo;
        }
        return $return;
    }
    
    // konfigurace vyhledavani
    public static function search_config()
    {
        return array(
                  "title"=>"Kontinenty",
                  "display_title"=>"product_category_data.nazev",
                  "display_text"=>"product_category_data.uvodni_popis",
                  "search_columns"=>array("product_category_data.nazev", "product_category_data.uvodni_popis", "product_category_data.popis")
        );
    }
}

?>
