<?php defined('SYSPATH') or die('No direct script access.');


class Service_Download extends Service_Hana_Page 
{

	public static $files_resources_dir="media/files/";

    public static function get_files_by_page_id($language_id,$page_id) {
		$result_data = array();

		$nodes =orm::factory('page_file')
			->where('page_id','=',$page_id)
			->where('language_id','=',$language_id)
			->where('zobrazit','=',1)
			->find_all();    	
    	
    	foreach ($nodes as $node) {
    		if($node->file_src){
    			$filename = self::$files_resources_dir.self::$navigation_module.'/item/files-'.$page_id.'/'.$node->file_src.'.'.$node->ext;
    			if(file_exists(str_replace('\\', '/',DOCROOT).$filename)) {
    				$result_data[$node->id] = $node->as_array();
    				$result_data[$node->id]['file'] = $filename;
    			}
    		}
    		
    	}
    	return $result_data;
    }
}