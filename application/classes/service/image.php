<?php defined('SYSPATH') or die('No direct script access.');

class Service_Image
{

    public static function get_images($max = 4, $language_id = 0)
    {
        $images = ORM::factory("image")
            ->where("zobrazit", "=", 1)
            ->language($language_id)
            ->limit($max)
            ->order_by("poradi")
            ->find_all();

        return $images;
    }

}

?>