<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Servisa pro obsluhu katalogu kategorii produktu.
 *
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */

class Service_Hana_Product_Category implements Interface_Searchable 
{
    public static $photos_resources_dir="media/photos/";
    public static $files_resources_dir="media/files/";
    public static $photo_detail_suffix="t1";
    public static $photo_thumb_suffix="t2";

    public static $default_order_by="poradi";
    public static $default_order_direction="asc";
    
    public static $with_favorites=false;
    
    public static $default_price_code="D0";
    
    public static function get_product_category_by_route_id($route_id=false, $parameters=array())
    {
        
        $photo_thumb_suffix=isset($parameters["photo_thumb_suffix"])?$parameters["photo_thumb_suffix"]:self::$photo_thumb_suffix;
        $photo_detail_suffix=isset($parameters["photo_detail_suffix"])?$parameters["photo_detail_suffix"]:self::$photo_detail_suffix;
        
        $search_string=isset($parameters["search_string"])?$parameters["search_string"]:null;
        $force=isset($parameters["force"])?$parameters["force"]:null;
        $nazev_seo=""; 
        $lang=1;
        
        if($route_id)
        {
            // ziskani kategorie
            $category=orm::factory("product_category")->where("product_category_data.route_id","=",$route_id);
            if(!$force) $category->where("zobrazit","=",1);
            $category=$category->find();
            $nazev_seo=$category->route->nazev_seo;
            $lang=$category->route->language_id;
            // Generovani vypisu produktu
            $product_data=array();
            $product_data["category_data"]=$category->as_array();
            // ziskani produktu pripojenych na kategorii
            //$products=$category->products;
        }
        else
        {
            $product_data["category_data"]=array();
            //$products=orm::factory("product");
        }
        //$lang = Hana_Application::instance()->get_actual_language_id();

        //$product_data["category_data"]=array();
        $products=DB::select("products.*")
                ->select("product_data.nazev","product_data.uvodni_popis","product_data.akce_text","product_data.k_prodeji")
                //->select(array("manufacturer_data.nazev","vyrobce"))
                ->select(array("routes.nazev_seo","product_nazev_seo"))->distinct(true);

        // pripojeni oblibenych a kategorie oblibenych
        if(Service_User::instance()->logged_in() && self::$with_favorites)
        {
            $shopper_id=Service_User::instance()->get_user()->id;
            if(isset($parameters["favorite_category"]))
            {    
                $special_mode="join_favorites";
            }else{
                $special_mode="left_join_favorites";
            }
            $products->select(array("shopper_favorite_products.id","favorite"));
        }
        else
        {
            $special_mode=false;
        }

        $products=self::_category_query_base($products,$special_mode);



        $products=self::_category_query_base_condition($products, $route_id, $search_string);
        $products=self::_category_query_filters_condition($products, $parameters);
        //$products->join("product_data")->on("products.id","=","product_data.product_id")
        $products->join("manufacturer_data","left")->on("manufacturers.id","=","manufacturer_data.manufacturer_id");
        $products->join(array("routes","routes"))->on("product_data.route_id","=","routes.id");
        //$products->join(array("routes","routes2"))->on("product_data.route_id","=","routes2.id");
        
                
        /////////////////////////////////////////////////////////////

        $products->where("routes.language_id","=",$lang);

        if(isset($parameters["where"]))       $products->where($parameters["where"][0],$parameters["where"][1],$parameters["where"][2]);
        //if(isset($parameters["like"]))        $products->like($parameters["like"]);
        $products->order_by(isset($parameters["order_by"])?$parameters["order_by"]:self::$default_order_by, isset($parameters["order_direction"])?$parameters["order_direction"]:self::$default_order_direction);
        if(isset($parameters["limit"]))       $products->limit($parameters["limit"]);
        if(isset($parameters["offset"]))      $products->offset($parameters["offset"]);
        //die($products);
        
        $products = $products->execute();

        foreach($products as $product)
        {
            
           $current_product=$product;
           $current_product["nazev_seo"]=$product["product_nazev_seo"];
           $current_product["cena_s_dph"] = orm::factory("product")->where("products.id","=",$product["id"])->find()->prices()->get_total_price_with_tax();

            // cesta k obrazku
           $filename=self::$photos_resources_dir."product/item/images-".$product["id"]."/".$product["photo_src"]."-".$photo_thumb_suffix.".jpg";
           if($product["photo_src"] && file_exists(str_replace('\\', '/',DOCROOT).$filename))
           {
                $current_product["photo"]=url::base().$filename;
           }
           // zaverecne vlozeni produktu do pole dat
           $product_data["products"][$product["id"]]=$current_product;
        }
        
        //die(print_r($product_data));
        return $product_data;
    }
    
    
    public static function get_carousel_product_categories($nazev_seo, $language_id)
    {
        $route_id=DB::select(array("routes.id","route_id"))->from("routes")->where("nazev_seo","=",$nazev_seo)->execute()->get("route_id");
        $parent_id=DB::select(array("product_categories.id","prcid"))->from("product_categories")
                            ->join("product_category_data")->on("product_categories.id","=","product_category_data.product_category_id")
                            ->where("product_category_data.route_id","=",$route_id)->execute()->get("prcid");
        
        $product_categories=orm::factory("product_category")->where("parent_id","=",$parent_id)->where("product_category_data.language_id","=",$language_id)->where("zobrazit","=",1)->order_by("poradi","asc")->find_all();
        
        $product_category_data=array();
        
        foreach($product_categories as $category)
        {
           $product_category_data[$category->id]=$category->as_array();
           $product_category_data[$category->id]["nazev_seo"]=$category->nazev_seo;
            // cesta k obrazku
           $filename=self::$photos_resources_dir."product/category/images-".$category->id."/".$category->photo_src."-t2.jpg";
           if(file_exists(str_replace('\\', '/',DOCROOT).$filename))
           {
                $product_category_data[$category->id]["photo"]=url::base().$filename;
           }
           
           $products=DB::select("product_data.id","product_data.nazev")->from("product_data")
                   ->join("products")->on("product_data.product_id","=","products.id")
                   ->join("routes")->on("product_data.route_id","=","routes.id")
                   ->join("product_categories_products")->on("products.id","=","product_categories_products.product_id")
                   ->where("routes.zobrazit","=",1)
                   ->where("product_category_id","=",$category->id)
                   ->order_by("poradi","asc")
                   ->limit(3)
                   ->as_object()
                   ->execute();
           foreach($products as $product)
           {
               $product_category_data[$category->id]["products"][$product->id]=$product->nazev;
           }
           
        }
        
        return $product_category_data;
    }
    
    
    


//************************************ pomocne metody pro sestaveni dotazu na vypis kategorii
     
    /**
     * Zakladni najoinovani tabulek - platne pro vsechny dotazy
     * @param string $special_mode najoinovani oblibenych, apod.
     */
    protected static function _category_query_base($query, $special_mode=false)
    {
        $query
        ->from("products")
        ->join("product_data")->on("products.id","=","product_data.product_id")          
        ->join("product_categories_products")->on("products.id","=","product_categories_products.product_id")
        ->join("product_categories")->on("product_categories_products.product_category_id","=","product_categories.id")
        ->join("product_category_data")->on("product_categories.id","=","product_category_data.product_category_id")
        //->join("routes")->on("product_category_data.route_id","=","routes.id")
        ;
        
        switch ($special_mode) {
            case "left_join_favorites":
                $shopper_id=Service_User::instance()->get_user()->id;
                $query->join("shopper_favorite_products","LEFT")->on("products.id","=","shopper_favorite_products.product_id")->on("shopper_favorite_products.shopper_id","=",db::expr($shopper_id));
                break;
            case "join_favorites":
                $shopper_id=Service_User::instance()->get_user()->id;
                $query->join("shopper_favorite_products")->on("products.id","=","shopper_favorite_products.product_id")->on("shopper_favorite_products.shopper_id","=",db::expr($shopper_id));
                break;
            
            default:
                break;
        }
   
        
        return $query;

    }
    

    /**
     * Vygeneruje cenove rozsahy pro zvolenou kategorii ci vysledek vyhledavani.
     * @param string $nazev_seo
     * @param string $search_string
     * @return 
     */
    protected static function _category_query_base_condition($query, $route_id=false, $search_string=false)
    {
        $query
        ->where("products.smazano","=", 0)
        ->where("product_data.zobrazit","=", 1)
        ->where("product_category_data.zobrazit","=", 1);
        
        if($route_id)
        {
            $query->where("product_category_data.route_id","=",$route_id);
        }
        
        if($search_string)
        {
            $query->and_where_open();
            $query->where("product_data.nazev","LIKE","%$search_string%");
            $query->or_where("product_data.uvodni_popis","LIKE","%$search_string%");
            $query->or_where("product_data.popis","LIKE","%$search_string%");
            $query->and_where_close();
        }
        
        return $query;
    }
    
    /**
     * najoinovani vsech potrebnych tabulek pro sestaveni dotazu na pocet zaznamu a na konkretni zaznamy
     * @param orm $query
     * @param array $parameters
     * @return type 
     */
    protected static function _category_query_filters_condition($query, $parameters=array())
    {
        $price_category_code=Service_Product_Price::get_price_category_code(Service_User::instance()->get_user()->price_category);
                
        //die($price_category_code);
        
        $hodnota_procentni_slevy_pro_skupinu=(Service_Product_Price::get_price_category_percentual_value(Service_User::instance()->get_user()->price_category))/100;
        
        $query
        ->group_by("products.id")
        //->join("price_categories_products")->on("products.id","=","price_categories_products.product_id")
        ->join("manufacturers","LEFT")->on("products.manufacturer_id","=","manufacturers.id");
//        ->join(array("product_parameters_products","ppp2"),"LEFT")->on("products.id","=","ppp2.product_id")
//        ->join(array("product_parameter_values","ppv2"))->on("ppp2.product_parameter_value_id","=","ppv2.id")->on("ppv2.product_parameter_id","=",DB::expr(1))
//        ->join(array("product_parameters_products","ppp1"),"LEFT")->on("products.id","=","ppp1.product_id")
//        ->join(array("product_parameter_values","ppv1"))->on("ppp1.product_parameter_value_id","=","ppv1.id")->on("ppv1.product_parameter_id","=",DB::expr(2));
        
        $case_string="
        (
                CASE
                WHEN pc2.price_type_id =1
                THEN
                (
                CASE
                WHEN products.percentage_discount >0
                THEN pcp2.cena * ( 1 - ( products.percentage_discount /100 ) ) 
                ELSE pcp2.cena
                END
                )
                WHEN $hodnota_procentni_slevy_pro_skupinu > (products.percentage_discount/100)
                THEN (`price_categories_products`.`cena` * ( 1 - ( $hodnota_procentni_slevy_pro_skupinu ) ) ) 
                ELSE (`price_categories_products`.`cena` * ( 1 - ( products.percentage_discount/100) ) )
                END
                )    
        ";
        
        //$query->select(array(db::expr(" (select hodnota from price_categories where kod = \"".$price_category_code."\")"),"price_sleva"));
        $query->select(array(db::expr($case_string),"price"));
        
        $query->join("price_categories_products")->on("products.id","=","price_categories_products.product_id");
        $query->join("price_categories")->on("price_categories_products.price_category_id","=","price_categories.id")->on("price_categories.kod","=",db::expr("\"D0\""));
        $query->join(array("price_categories_products","pcp2"),"LEFT")->on("products.id","=","pcp2.product_id");
        $query->join(array("price_categories","pc2"),"LEFT")->on("pcp2.price_category_id","=","pc2.id")->on("price_categories.kod","=",db::expr("\"".$price_category_code."\""));
        
        
        if(isset($parameters["price_selected_max"])) $query->having("price","<=",$parameters["price_selected_max"]);
        if(isset($parameters["price_selected_min"])) $query->having("price",">=",$parameters["price_selected_min"]);
        //if(isset($parameters["products_filter_manufacturer"])) $query->where("products.manufacturer_id","=",$parameters["products_filter_manufacturer"]);
        if(isset($parameters["products_filter_manufacturers"])) $query->where("products.manufacturer_id","IN",db::expr("(".implode(",", $parameters["products_filter_manufacturers"]).")"));
//        if(isset($parameters["products_filter_colors"]) && is_array($parameters["products_filter_colors"])) $query->where("ppv2.id","IN",db::expr("(".implode(",", $parameters["products_filter_colors"]).")"));
//        if(isset($parameters["products_filter_sizes"]) && is_array($parameters["products_filter_sizes"])) $query->where("ppv1.id","IN",db::expr("(".implode(",", $parameters["products_filter_sizes"]).")"));
//        
//        if(isset($parameters["products_filter_size"])) $query->where("ppv1.id","IN",db::expr("(".implode(",", $parameters["products_filter_size"]).")"));
//        if(isset($parameters["products_filter_color"])) $query->where("ppv2.id","IN",db::expr("(".implode(",", $parameters["products_filter_color"]).")"));
//        
        return $query;
    }
    
    
    /**
     * Ziska rozsah cen v dane kategorii (podle nazvu sea, nebo vyhledavanim)
     * @param type $route_id
     * @param type $search_string
     * @param string $special_mode najoinovani oblibenych, apod.
     * @return array 
     */
    public static function get_category_price_ranges($route_id=false, $special_mode=false)
    {
        $search_string=isset($parameters["search_string"])?$parameters["search_string"]:null;
        // zjistime $price category id
        $price_category_value=Service_Product_Price::get_price_category_percentual_value(Service_User::instance()->get_user()->price_category);
        if($price_category_value==0) 
        {   
            $price_category_code=Service_Product_Price::get_price_category_code(Service_User::instance()->get_user()->price_category);
        }
        else
        {
            // pokud je nastavena sleva procentem, vezmu puvodni cenovou kategorii D0
            $price_category_code=self::$default_price_code;
        } 
        $hodnota_procentni_slevy_pro_skupinu=(Service_Product_Price::get_price_category_percentual_value(Service_User::instance()->get_user()->price_category))/100;
        
        $query=DB::select(array(db::expr("
                min(
                CASE
                WHEN pc2.price_type_id =1
                THEN
                (
                CASE
                WHEN products.percentage_discount >0
                THEN pcp2.cena * ( 1 - ( products.percentage_discount /100 ) ) 
                ELSE pcp2.cena
                END
                )
                WHEN $hodnota_procentni_slevy_pro_skupinu > (products.percentage_discount/100)
                THEN (`price_categories_products`.`cena` * ( 1 - ( $hodnota_procentni_slevy_pro_skupinu ) ) ) 
                ELSE (`price_categories_products`.`cena` * ( 1 - ( products.percentage_discount/100) ) )
                END
                )
                "),"cena_min"));
                

        $query->join("price_categories_products")->on("products.id","=","price_categories_products.product_id");
        $query->join("price_categories")->on("price_categories_products.price_category_id","=","price_categories.id")->on("price_categories.kod","=",db::expr("\"D0\""));
        $query->join(array("price_categories_products","pcp2"))->on("products.id","=","pcp2.product_id");
        $query->join(array("price_categories","pc2"))->on("pcp2.price_category_id","=","pc2.id")->on("price_categories.kod","=",db::expr("\"".$price_category_code."\""));
        $query=self::_category_query_base($query, $special_mode);
        $query=self::_category_query_base_condition($query, $route_id, $search_string);
        //die($query);
        $result=$query->as_object()->execute()->current();
        $range["price_min"]=floor(($result->cena_min)?$result->cena_min:0);
        
        $query2=DB::select(array(db::expr("
                max(
                CASE
                WHEN pc2.price_type_id =1
                THEN
                (
                CASE
                WHEN products.percentage_discount >0
                THEN pcp2.cena * ( 1 - ( products.percentage_discount /100 ) ) 
                ELSE pcp2.cena
                END
                )
                WHEN $hodnota_procentni_slevy_pro_skupinu > (products.percentage_discount/100)
                THEN (`price_categories_products`.`cena` * ( 1 - ( $hodnota_procentni_slevy_pro_skupinu ) ) ) 
                ELSE (`price_categories_products`.`cena` * ( 1 - ( products.percentage_discount/100) ) )
                END
                )
                "),"cena_max"));
                

        $query2->join("price_categories_products")->on("products.id","=","price_categories_products.product_id");
        $query2->join("price_categories")->on("price_categories_products.price_category_id","=","price_categories.id")->on("price_categories.kod","=",db::expr("\"D0\""));
        $query2->join(array("price_categories_products","pcp2"))->on("products.id","=","pcp2.product_id");
        $query2->join(array("price_categories","pc2"))->on("pcp2.price_category_id","=","pc2.id")->on("price_categories.kod","=",db::expr("\"".$price_category_code."\""));
        $query2=self::_category_query_base($query2, $special_mode);
        $query2=self::_category_query_base_condition($query2, $route_id, $search_string);
        //die($query);
        $result2=$query2->as_object()->execute()->current();
        $range["price_max"]=ceil(($result2->cena_max)?$result2->cena_max:0);

        return $range;
    }
    
    public static function get_category_manufacturers($route_id=false, $ma=array(), $co=array(), $si=array(), $special_mode=false)
    {
        $search_string=isset($parameters["search_string"])?$parameters["search_string"]:null;
        $query=DB::select(array("manufacturer_data.nazev","manufacturer"))->select(array("manufacturers.id","id"))->distinct(true);
        $query=self::_category_query_base($query, $special_mode);
        $query->join("manufacturers","LEFT")->on("products.manufacturer_id","=","manufacturers.id")
        ->join("manufacturer_data","LEFT")->on("manufacturers.id","=","manufacturer_data.manufacturer_id");
        // rozsireni o zavislost na ostatnich filtrech
        if(!empty($co))
        {
            $query->join(array("product_parameters_products","ppp2"),"LEFT")->on("products.id","=","ppp2.product_id")
            ->join(array("product_parameter_values","ppv2"))->on("ppp2.product_parameter_value_id","=","ppv2.id")->on("ppv2.product_parameter_id","=",DB::expr(1))
            ->where("ppv2.id","IN",db::expr("(".implode(",", $co).")"));
        }
        
        if(!empty($si))
        {
            $query->join(array("product_parameters_products","ppp1"),"LEFT")->on("products.id","=","ppp1.product_id")
            ->join(array("product_parameter_values","ppv1"))->on("ppp1.product_parameter_value_id","=","ppv1.id")->on("ppv1.product_parameter_id","=",DB::expr(2))
            ->where("ppv1.id","IN",db::expr("(".implode(",", $si).")"));
        }
                
                $query->order_by("manufacturer","asc");
        
        $query=self::_category_query_base_condition($query, $route_id, $search_string);
        $result=$query->execute()->as_array();
        
        return $result;
    }   
    
    public static function get_category_total_items($route_id=false, $parameters=array(), $special_mode=false)
    {
        $search_string=isset($parameters["search_string"])?$parameters["search_string"]:null;
        $query=DB
        ::select(array(DB::expr('COUNT(DISTINCT(products.id))'),"total_products"));
        $query=self::_category_query_base($query, $special_mode);
        $query=self::_category_query_base_condition($query, $route_id, $search_string);
        $query=self::_category_query_filters_condition($query, $parameters);
        $query->group_by("products.id");
        //die($query);
        $result=$query->as_object()->execute();
        
        $count=0;
        foreach($result as $res)
        {
            $count++;
        }
        
 
        return $count;
       
        //return $result->total_products;
    }
    
    public static function is_empty_category($route_id=false, $special_mode=false){
        $search_string=isset($parameters["search_string"])?$parameters["search_string"]:null;
        $query=DB::select(array("products.id","id"));
        $query=self::_category_query_base($query, $special_mode);
        $query=self::_category_query_base_condition($query, $route_id, $search_string);
        $query=$query->limit(1);
        $result=$query->execute()->as_array();

        return (isset($result[0]["id"]) && $result[0]["id"])?false:true;
    }
    
    
    public static function get_navigation_category_breadcrumb($nazev_seo)
    {
        $result_data = DB::select("product_category_data.nazev","routes.nazev_seo","routes.language_id","product_categories.parent_id")
                ->from("product_categories")
                ->join("product_category_data")->on("product_categories.id","=","product_category_data.product_category_id")
                ->join("routes")->on("product_category_data.route_id","=","routes.id")
                ->where("routes.nazev_seo","=",$nazev_seo)
                //->where("routes.zobrazit","=",DB::expr(1))
                ->execute()->as_array();
        //die(print_r($result_data));
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
    
    // konfigurace vyhledavani
    public static function search_config()
    {
        return array(
                  "title"=>"kategorie produktů",
                  "display_title"=>"product_category_data.nazev",
                  "display_text"=>"product_category_data.uvodni_popis",
                  "search_columns"=>array("product_category_data.nazev", "product_category_data.uvodni_popis", "product_category_data.popis")
        );
    }
}

?>
