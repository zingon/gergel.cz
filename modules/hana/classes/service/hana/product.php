<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Servisa pro obsluhu katalogu produktu.
 *
 * @author     Pavel Herink
 * @copyright  (c) 2010 Pavel Herink
 */
class Service_Hana_Product extends Service_Hana_Module_Base
{
    public static $photos_resources_dir="media/photos/";
    public static $files_resources_dir="media/files/";
    public static $photo_detail_suffix="t1";
    public static $photo_thumb_suffix="t2";

    public static $with_favorites=false;
        
    

    /**
     * Nacte produkt dle route id.
     * @param int $route_id
     * @return orm 
     */
    public static function get_product_detail_by_route_id($route_id)
    {
        
        $product_orm=orm::factory("product")->where("route_id","=",$route_id)->where("zobrazit","=",1)->find();
        
        $product_data=$product_orm->as_array();
       // $product_data["vyrobce"]=$product_orm->manufacturer->nazev;
        $product_data["kategorie"]=$product_orm->product_categories->order_by("priorita","DESC")->find()->nazev_seo;
        $product_data["nazev_seo"]=$product_orm->route->nazev_seo;
        
        // ke kazdemu produktu ziskam podle cenove skupiny i hodnotu ceny
        $product_data["cena_s_dph"] = $product_orm->prices()->get_total_price_with_tax();
        $product_data["cena_bez_dph"] = $product_orm->prices()->get_total_price_without_tax();
        $product_data["cena_s_dph_bez_slevy"] = $product_orm->prices()->get_raw_price_with_tax();
        
        // zjistim zda je produkt zarazen v nejake akcni (specialni) kategorii

        $special_categories=$product_orm->product_categories->where("special_code","!=","")->find_all();
        $spc_array=array();
        foreach($special_categories as $item)
        {
            $spc_array[]=$item->special_code;
        }
        $product_data["specialni_kategorie"]=$spc_array;

        // cesta k obrazku
        $dirname=self::$photos_resources_dir."product/item/images-".$product_orm->id."/";
        

        if($product_orm->photo_src && file_exists(str_replace('\\', '/',DOCROOT).$dirname.$product_orm->photo_src."-t2.jpg"))
        {
            $product_data["photo_detail"]=url::base().$dirname.$product_orm->photo_src."-".self::$photo_detail_suffix.".jpg";
        }

        // vylistovani technickych dat (parametru produktu)
//        $prod_par_orm=$product_orm->product_parameters->join("product_parameters_types","left")->on("product_parameters.product_parameters_type_id","=","product_parameters_types.id")->join("product_parameters_type_data","left")->on("product_parameters_types.id","=","product_parameters_type_data.product_parameters_type_id")->select(array("product_parameters_type_data.nazev","typ"))->select(array("product_parameters_products_data.hodnota","phodnota"))->join("product_parameters_products_data")->on("product_parameters_products.id","=","product_parameters_products_data.product_parameters_products_id")->order_by("product_parameters_types.poradi","asc")->order_by("product_parameters.poradi","asc")->find_all();
//        $product_parameters=array();
//        foreach($prod_par_orm as $item)
//        {
//            $product_parameters[$item->typ][]=array("nazev"=>$item->nazev,"hodnota"=>$item->phodnota);
//        }
//        $product_data["technicka_data"]=$product_parameters;
//
        // cesta zpet
//        $product_data["back_link"]=Session::instance()->get("actual_query");
 
        
//        // vylistovani fotogalerii
//        $photos=$product_orm->product_photos->where("product_photos.zobrazit","=",1)->find_all();
//        $dirname=$this->photos_resources_dir."product/item/gallery/images-".$product_orm->id."/";
//        $photos_array=array();
//        $x=1;
//        foreach($photos as $photo)
//        {
//            if($photo->photo_src && file_exists(str_replace('\\', '/',DOCROOT).$dirname.$photo->photo_src."-t2.jpg"))
//            {
//                $photos_array[$x]["photo"]=url::base().$dirname.$photo->photo_src."-t4.jpg";
//                $photos_array[$x]["photo_seo"]=$photo->photo_src;
//                $photos_array[$x]["photo_detail"]=url::base().$dirname.$photo->photo_src."-t1.jpg";
//                $photos_array[$x]["nazev"]=$photo->nazev;
//                $x++;
//            }
//        }
//        $product_data["fotogalerie"]=$photos_array;
//        
//       
//        // vylistovani souburu
//        $files=$product_orm->product_files->where("product_file_data.language_id","=",$product_data["language_id"])->where("product_files.zobrazit","=",1)->find_all();
//        $filedirname=$this->files_resources_dir."product/item/files-".$product_orm->id."/";
//        $files_array=array();
//        $x=1;
//        foreach($files as $file)
//        {    
//            if($file->file_src && file_exists(str_replace('\\', '/',DOCROOT).$filedirname.$file->file_src.".".$file->ext))
//            {
//                $files_array[$x]["file"]=url::base().$filedirname.$file->file_src.".".$file->ext;
//                $files_array[$x]["nazev"]=$file->nazev;
//                $files_array[$x]["ext"]=$file->ext;
//                $files_array[$x]["file_thumb"]=url::base()."media/admin/img/icons/".$file->ext.".png";
//                $x++;
//            }
//        }
//        $product_data["files"]=$files_array;
        //die(print_r($product_data));
        return $product_data;
    }
    
    /**
     * Vygeneruje kategorii produktu dle route id.
     * @param type $route_id 
     */
    
    
    /**
     * Vrati darky k hodnote nakupu zdarma (TODO - mozno implementovat ruzne urovne)
     * @param type $cart_price_with_tax
     * @return type 
     */
    public static function get_presents($cart_price_with_tax=false, $force=false)
    {
        $product_data=array();
        
        $products_orm=orm::factory("product")->where("zobrazit","=",1)->where("gift","=",1)->find_all();
        foreach($products_orm as $item)
        {
           if($item->gift_threshold_price <= $cart_price_with_tax || $cart_price_with_tax==false)
           {
               $product_data[$item->id]=$item->as_array(); 
               $product_data[$item->id]["nazev_seo"]=$item->route->nazev_seo;
           }
        }
        
        return $product_data;
    }

    public static function is_free_present($present_id, $cart_price_with_tax)
    {
        $price_threshold=DB::select("gift_threshold_price")->from("products")->where("id","=",$present_id)->where("gift","=",1)->execute()->get("gift_threshold_price");
        return ($price_threshold > 0 && $cart_price_with_tax > 0 && $cart_price_with_tax > $price_threshold)?true:false;
    }
    
    public static function toggle_favorites($user_id, $product_id)
    {
        $favorite=orm::factory("Shopper_Favorite_Product")->where("shopper_id","=",$user_id)->where("product_id","=",$product_id)->find();
        if($favorite->id)
        {
            $favorite->delete();
            return false;
        }
        else
        {
           $favorite->shopper_id=$user_id;
           $favorite->product_id=$product_id;
           $favorite->save();
           return true;
        }
    }
    
    // metody na generovani cen byly presunuty do samostatne tridy Service_Product_Price

    
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public static function get_products_in_carousel(){
        $products_data = array();

       $data = DB::select("products.id","price_categories_products.cena","products.availability","products.photo_src","products.jednotka","product_data.nazev","product_data.k_prodeji","product_data.uvodni_popis","routes.nazev_seo",array("routes.id","routes_id"))
           ->from("products")
           ->join("product_data")->on("products.id","=","product_data.product_id")
           ->join("routes")->on("product_data.route_id","=","routes.id")
           ->join("price_categories_products")->on("products.id", "=" ,"price_categories_products.product_id")
           ->where("product_data.zobrazit_carousel","=",1)
           ->and_where("products.smazano","=",0)
           ->and_where("product_data.zobrazit","=",1)
           ->and_where("product_data.k_prodeji","=",1)
           ->as_object()->execute();

       foreach($data as $item)
       {

           // cesta k obrazku
           $dirname=self::$photos_resources_dir."product/item/images-".$item->id."/";
//
           $products_data[$item->id]['id'] = $item->id;
           $products_data[$item->id]['photo'] = $dirname.$item->photo_src."-".self::$photo_thumb_suffix.".jpg";
           $products_data[$item->id]['nazev'] = $item->nazev;
           $products_data[$item->id]['cena_s_dph'] = $item->cena;
           $products_data[$item->id]['k_prodeji'] = $item->k_prodeji;
           $products_data[$item->id]['uvod'] = $item->uvodni_popis;
           $products_data[$item->id]['jednotka'] = $item->jednotka;
           $products_data[$item->id]['availability'] = $item->availability;
           $products_data[$item->id]['detail'] = self::get_product_detail_by_route_id($item->routes_id);
           $products_data[$item->id]['nazev_seo'] = $item->nazev_seo;
       }

       return $products_data;
   }
    

    /**
     * Metoda na vygenerovani produktove navigace struktury "Products" 
     * 
     * @param type $language_id
     * @param type $category - typ navigace 
     * @param type $max_levels - maximum generovanych urovni
     * @param type $breadcrumbs $breadcrumbs aktualni cesta (vygeneruje pouze vetve, ktere jsou v ramci retezce zvolene cesty)
     * @param type $parent_id pomocna promenna
     * @param type $counter pomocna promenna
     * @return type 
     */
    public static function get_navigation($language_id,$category=1,$max_levels=false,$breadcrumbs=array(),$parent_id=0,$counter=1)
    {
          $result_data=array();
          $nodes = DB::select("product_category_data.nazev","routes.nazev_seo","routes.language_id","product_categories.parent_id","product_categories.id")
                ->from("product_categories")
                ->join("product_category_data")->on("product_categories.id","=","product_category_data.product_category_id")
                ->join("routes")->on("product_category_data.route_id","=","routes.id")
                ->where("product_categories.parent_id","=",db::expr($parent_id))
                ->where("routes.language_id","=",DB::expr($language_id))
                ->where("routes.zobrazit","=",DB::expr(1))
                ->order_by("poradi")
                ->as_object()->execute();
          foreach($nodes as $node)
          { 
              $result_data[$node->nazev_seo]=(array)$node;
              // podrizene vetve
              $child_nodes=array();
              if(($max_levels && $max_levels>$counter) || $max_levels===false)
              {
                  if((!empty($breadcrumbs) && key_exists($node->nazev_seo, $breadcrumbs)) || empty($breadcrumbs))
                  {
                     $child_nodes=self::get_navigation($language_id, $category, $max_levels, $breadcrumbs, $node->id, $counter+1);
                     if(!empty($child_nodes))
                     {
                        $result_data[$node->nazev_seo]["children"]=$child_nodes;

                     }
                  }
              }
          }
          return $result_data;
          
    }
    
    /**
     * Vrati celou cestu drobitkove navigace dle koncoveho sea.
     * @param type $nazev_seo
     * @return array 
     */
    public static function get_navigation_breadcrumbs($nazev_seo)
    {
        //nutno zjistit, zda jde o produkt, nebo kategorii
        $module_action=  Hana_Application::instance()->get_main_controller_action();
        $module_code= Hana_Application::instance()->get_main_controller();
        
        $product_data=array();
        
        if($module_action=="index")
        {
            return(array());
        }
        elseif($module_action=="detail")
        {
            $product_data = DB::select("product_data.nazev","routes.nazev_seo","routes.language_id","products.id")
                ->from("products")
                ->join("product_data")->on("products.id","=","product_data.product_id")
                ->join("routes")->on("product_data.route_id","=","routes.id")
                ->where("routes.nazev_seo","=",$nazev_seo)
                //->where("routes.zobrazit","=",DB::expr(1))
                ->execute()->as_array();
             $product_data=$product_data[0];
                 
            // opatreni k zobrazeni vzdy spravne cesty a oznacenych polozek v produktovem menu, pokud je produkt zavesen do vice kategorii     
            $session=Session::instance();
            $nazev_seo_from_category = $session->get("last_product_category",false);
            $nazev_seo_from_product = $session->get("last_product_category_product",false);
            $last_product_id = $session->get("last_product_id_from_category",false);
            
            if($nazev_seo_from_category)
            {
                // pristup z kategorie
               $nazev_seo=$nazev_seo_from_category;
               $session->set("last_product_category_product", $nazev_seo);
               $session->set("last_product_id_from_category",$product_data["id"]);
               $session->set("last_product_category",false);
            }
            elseif($nazev_seo_from_product && $last_product_id==$product_data["id"])
            {
               // refresh na produktu (zustavame na stejnem produktu)
               $nazev_seo=$nazev_seo_from_product; 
            }
            else
            {
               // primy pristup na produkt (bez predchoziho vyberu z kategorie) - defaultni funkcionalita:
                 // seo kategorie s nejvyssi prioritou pripojenou na produkt
                 $nazev_seo = DB::select("routes.nazev_seo")
                    ->from("routes")
                    ->join("product_category_data")->on("routes.id","=","product_category_data.route_id")
                    ->join("product_categories")->on("product_category_data.product_category_id","=","product_categories.id")
                    ->join("product_categories_products")->on("product_category_data.product_category_id","=","product_categories_products.product_category_id")
                    ->where("product_categories_products.product_id","=",$product_data["id"])
                    ->order_by("product_categories.priorita","DESC")      
                    ->limit(1)     
                    //->where("routes.zobrazit","=",DB::expr(1))
                    ->execute()->get("nazev_seo");
            }
        }
        elseif($module_action=="category")
        {}
        $category_breadcrumbs=array();
        do
        {
            $category_breadcrumbs[$nazev_seo]=Service_Product_Category::get_navigation_category_breadcrumb($nazev_seo);
            
            if(!empty($category_breadcrumbs[$nazev_seo]["parent_nazev_seo"]))
            {
                $nazev_seo=$category_breadcrumbs[$nazev_seo]["parent_nazev_seo"];
            }
            else
            {
                $category_breadcrumbs[$nazev_seo]["parent_nazev_seo"]=DB::select("routes.nazev_seo")->from("routes")->join("modules")->on("routes.module_id","=","modules.id")->where("modules.kod","=",$module_code)->where("routes.module_action","=","index")->where("routes.zobrazit","=",DB::expr(1))->where("routes.language_id","=",Hana_Application::instance()->get_actual_language_id())->execute()->get("nazev_seo");
                $nazev_seo="";
            }
        }
        while($nazev_seo);
        
        if(!empty($product_data))
        {
            $breadcrumbs=array_merge(array($product_data["nazev_seo"]=>$product_data),$category_breadcrumbs);
        }
        else
        {
            $breadcrumbs=$category_breadcrumbs;
        }
        
        return($breadcrumbs);
        
    }
    
    public static function search_config()
    {
        return array(

                  "title"=>"produkty",
                  "display_title"=>"product_data.nazev",
                  "display_text"=>"product_data.uvodni_popis",
                  "search_columns"=>array("product_data.nazev", "product_data.uvodni_popis", "product_data.popis")
           
        );
    }
}
?>
