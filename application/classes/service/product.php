<?php defined('SYSPATH') or die('No direct script access.');

class Service_Product extends Service_Hana_Product
{

    public static function get_for_homepage($limit = 0, $language_id = 0)
    {
        $return = array();
        $products = ORM::factory("catalog")
            ->join('routes')->on('product_data.route_id', '=', 'routes.id')
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

}

?>