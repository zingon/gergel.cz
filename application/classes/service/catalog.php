<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Servisa pro obsluhu jednoducheho katalogu produktu. Pro e-shop je urcena servisa "product". 
 *
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Service_Catalog extends Service_Hana_Module_Base
{
	protected static $navigation_module="catalog";
	protected static $order_by="poradi";
	protected static $order_direction="asc";


	protected static $photos_resources_dir="media/photos/";
	protected static $files_resources_dir="media/files/";

	protected static $thumbs = array("big"=>"ad","small"=>"at");
	
	/**
	 * Nacte clanek dle route_id
	 * @param int $id
	 * @return array 
	 */
	public static function get_catalog_item_by_route_id($id)
	{
		$product_orm= orm::factory(self::$navigation_module)->where("route_id","=",$id)->find();
		
		$result_data=array();
		$result_data=$product_orm->as_array();
		$result_data["nazev_seo"]=$product_orm->route->nazev_seo;

		$filename=self::$photos_resources_dir.self::$navigation_module."/item/images-".$product_orm->id."/".$product_orm->photo_src."-t2.jpg";
		if(file_exists(str_replace('\\', '/',DOCROOT).$filename))
		{
			$result_data["photo_detail"]=url::base().$filename;
		}
		else
		{
			$result_data["photo_detail"]=false;
		}
		
		//$files=$product_orm->product_files->where("product_file_data.language_id","=",$product_orm->language_id)->where("product_files.zobrazit","=",1)->find_all();
		
		$filedirname=self::$files_resources_dir."catalog/item/files-".$product_orm->id."/";
		$files_array=array();
		$result_data["files"]=$files_array;
		
		return $result_data;
	}
	
	public static function get_catalog_total_items_list($language_id,$category=0)
	{
		return DB::select(db::expr("COUNT(catalogs.id) as pocet"))->from("catalogs")->join("catalog_data")->on("catalogs.id","=","catalog_data.catalog_id")->join("routes")->on("catalog_data.route_id","=","routes.id")->where("routes.zobrazit","=",1)->where("routes.language_id","=",$language_id)->execute()->get("pocet");   
	}
	
	/**
	 * Nacte sadu clanku podle kategorie a jazykove verze
	 * @param type $language_id
	 * @return boolean 
	 */
	public static function get_catalog_items_list($category_id, $language_id,$limit=100,$offset=0,$homepage=false)
	{
		$products=orm::factory("product")
				->join("routes")->on("product_data.route_id","=","routes.id")
				//->join("product_categories_products")->on("products.id","=","product_categories_products.product_id")
				//->where("product_categories_products.product_category_id","=",$category_id)
				->where("language_id","=",$language_id)
				->where("products.product_category_id","=",$category_id)
				->where("zobrazit","=",1)
				->order_by(self::$order_by,self::$order_direction)
				->limit($limit)
				->offset($offset)
				->find_all();
		
		$result_data=array();
		foreach ($products as $product)
		{
			$result_data[$product->id]=$product->as_array();
			$result_data[$product->id]["nazev_seo"]=$product->route->nazev_seo;
			
			$result_data[$product->id]['photos'] = array();

			$photos_orm = $product->product_photos
							->where("zobrazit","=",1)
							->where("language_id","=",$language_id)
							->order_by(self::$order_by,self::$order_direction)
							->find_all();
			foreach ($photos_orm as $photo) {
				if($photo->photo_src){
					
					$result_data[$product->id]['photos'][$photo->id] = $photo->as_array();
					$dirname = self::$photos_resources_dir.self::$navigation_module."/item/gallery/images-".$product->id."/";

					foreach (self::$thumbs as $name => $thumb) {
						if(file_exists(str_replace('\\', '/',DOCROOT).$dirname.$photo->photo_src."-".$thumb.".jpg")){
							$result_data[$product->id]['photos'][$photo->id][$name] = $dirname.$photo->photo_src."-".$thumb.".jpg";
						}
					} 
				}
			}
		}

		return $result_data;
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
	

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
		  $nodes = DB::select("product_category_data.nazev","product_categories.template","routes.nazev_seo","routes.language_id",/*"product_categories.parent_id",*/"product_categories.id", "product_categories.class")
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
		  //die(print_r($result_data));
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
			$category_breadcrumbs[$nazev_seo]=Service_Catalog_Category::get_navigation_category_breadcrumb($nazev_seo);
			
			if(!empty($category_breadcrumbs[$nazev_seo]["parent_nazev_seo"]))
			{
				$nazev_seo=$category_breadcrumbs[$nazev_seo]["parent_nazev_seo"];
			}
			else
			{
				$category_breadcrumbs[$nazev_seo]["parent_nazev_seo"]=DB::select("routes.nazev_seo")->from("routes")->join("modules")->on("routes.module_id","=","modules.id")->where("modules.kod","=",$module_code)->where("routes.module_action","=","index")->where("routes.zobrazit","=",DB::expr(1))->execute()->get("nazev_seo");
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
		//print_r($breadcrumbs);
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

