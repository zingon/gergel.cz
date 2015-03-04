<?php defined('SYSPATH') or die('No direct script access.');


class Service_Search extends Service_Hana_Search
{

    public static function setup_search()
    {
        return array("page","product","product_category");
    }
    
}
?>

