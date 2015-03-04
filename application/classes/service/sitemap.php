<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * Obsluha generovani sitemap.xml
 *
 * @package    Hana
 * @author     Pavel Herink
 * @copyright  (c) 2011 Pavel Herink
 */
class Service_Sitemap
{
    static $_modules=array("page","article"); // seznam modulu ze kterych se generuje sitemap

    public static function get_google_sitemap()
    {
        $base = URL::base(FALSE, 'http');
        $sitemap = new Sitemap;

        foreach(self::$_modules as $module)
        {
            $module_orm = DB::select($module."_data.id")
                ->select(array("routes.id","route_id"))
                ->select(array("routes.nazev_seo","route_nazev_seo"))
                ->from($module."_data")
                ->join("routes")->on($module."_data.route_id","=","routes.id")
                ->where("routes.zobrazit","=",1)
                ->execute();

            
            foreach($module_orm as $item)
            {
                $url = new Sitemap_URL();
                $nazev_seo=$item["route_nazev_seo"];
                if($nazev_seo=="index") $nazev_seo="";
                $url->set_loc($base.$nazev_seo);
                $sitemap->add($url);
            }

        }

        $sitemap_file_handle=fopen("sitemap.xml","w");
        fwrite($sitemap_file_handle,$sitemap);
        fclose($sitemap_file_handle);

    }

}
?>
