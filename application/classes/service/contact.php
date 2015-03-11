<?php defined('SYSPATH') or die('No direct script access.');


class Service_Contact extends Service_Hana_Page 
{
    public static function get_map()
    {
    	$map = DB::select('map_url')->from('owner_data')->limit(1)->execute();
    	return $map[0]['map_url'];
    }
}
?>