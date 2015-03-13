<?php defined('SYSPATH') or die('No direct script access.');

class Service_Reference extends Service_Hana_Module_Base
{


	public static $order_by="poradi";
    public static $order_direction="asc";

    public static $photo_dir = "/media/photos/reference/item/";

    protected static $thumbs = array('small'=>'at','big'=>'ad');
    protected static $navigation_module = "reference";

	public static function get_reference_list($language_id)
	{
		$result_data = array();
		$nodes = orm::factory('reference')
				->join('routes')->on('reference_data.route_id','=','routes.id')
				->language($language_id)
				->where('zobrazit','=',1)
				->order_by(self::$order_by,self::$order_direction)
				->find_all();

		foreach ($nodes as $node) {

			$result_data[$node->id] = $node->as_array();
			$result_data[$node->id]['nazev_seo'] = $node->nazev_seo;
			
			if($node->photo_src or $node->icon_src){
				foreach (self::$thumbs as $key => $thumb) {
					$dirname=self::$photo_dir . 'images-'. $node->id.'/'.$node->photo_src.'-'.$thumb.'.png';

					if(file_exists(str_replace('\\', '/', DOCROOT).$dirname)){
						$result_data[$node->id]['photo'][$key] = $dirname;
					}
					$dirname=self::$photo_dir . 'images-'. $node->id.'/'.$node->icon_src.'-'.$thumb.'.png';
					if(file_exists(str_replace('\\', '/', DOCROOT).$dirname)){
						$result_data[$node->id]['icon'][$key] = $dirname;
					}
				}	
			}
			
			

			/*$photos_orm = $node->reference_photos
							->where('zobrazit','=',1)
							->where('language_id','=',$language_id)
							->order_by(self::$order_by,self::$order_direction)
							->find_all();

			foreach ($photos_orm as $photo) {
				foreach (self::$thumbs as $key => $thumb) {

					$dirname=self::$photo_dir . 'gallery/images-'. $node->id.'/'.$photo->photo_src.'-'.$thumb.'.jpg';

					if($photo->photo_src && file_exists(str_replace('\\', '/', DOCROOT).$dirname)){
						$result_data[$node->id]['photos'][$photo->id] = $photo->as_array();
						$result_data[$node->id]['photos'][$photo->id][$key] = $dirname;
					}
				}
			}*/
		}
		return $result_data;


	}

	public static function get_reference_by_route_id($route_id){
		$result_data = array();
		$node = orm::factory('reference')
				->join('routes')->on('reference_data.route_id','=','routes.id')
				->where('route_id','=',$route_id)
				->where('zobrazit','=',1)
				->find();
		$result_data = $node->as_array();

		if($node->photo_src or $node->icon_src){
			foreach (self::$thumbs as $key => $thumb) {
				$dirname=self::$photo_dir . 'images-'. $node->id.'/'.$node->photo_src.'-'.$thumb.'.png';

				if(file_exists(str_replace('\\', '/', DOCROOT).$dirname)){
					$result_data['photo'][$key] = $dirname;
				} else {
					$result_data['photo'][$key] = "";
				}
				$dirname=self::$photo_dir . 'images-'. $node->id.'/'.$node->icon_src.'-'.$thumb.'.png';
				if(file_exists(str_replace('\\', '/', DOCROOT).$dirname)){
					$result_data['icon'][$key] = $dirname;
				} else {
					$result_data['icon'][$key] = "";
				}
			}	
		}

		$result_data['photos'] = array();
		$photos_orm = $node->reference_photos
							->where('zobrazit','=',1)
							->where('language_id','=',$node->language_id)
							->order_by(self::$order_by,self::$order_direction)
							->find_all();

		foreach ($photos_orm as $photo) {
			$result_data['photos'][$photo->id] = $photo->as_array();
			foreach (self::$thumbs as $key => $thumb) {

				$dirname=self::$photo_dir . 'gallery/images-'. $node->id.'/'.$photo->photo_src.'-'.$thumb.'.jpg';

				if($photo->photo_src && file_exists(str_replace('\\', '/', DOCROOT).$dirname)){
					
					$result_data['photos'][$photo->id][$key] = $dirname;
				}
			}
		}


		return $result_data;

	}
}