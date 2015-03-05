<?php defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * Servisa pro obsluhu clanku.
 *
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Service_Article extends Service_Hana_Module_Base
{
    public static $navigation_module="article";
    public static $order_by="date";
    public static $order_direction="desc";


    public static $photos_resources_dir="media/photos/";
    public static $photos_resources_subdir="";
    
    /**
     * Nacte clanek dle route_id
     * @param int $id
     * @return array 
     */
    public static function get_article_by_route_id($id)
    {
        $article= orm::factory(self::$navigation_module)->where("route_id","=",$id)->find();
        
        $result_data=array();
        $result_data = $article->as_array();
        $result_data["nazev_seo"]=$article->route->nazev_seo;

        $filename=self::$photos_resources_dir.self::$navigation_module."/item/".self::$photos_resources_subdir."images-".$article->id."/".$article->photo_src."-t2.jpg";
        if(file_exists(str_replace('\\', '/',DOCROOT).$filename))
        {
            $result_data["photo"]=url::base().$filename;
        }
        else
        {
            $result_data["photo"]=false;
        }


        
        
        return $result_data;
    }
    
    public static function get_article_total_items_list($language_id,$category=0)
    {
        return DB::select(db::expr("COUNT(articles.id) as pocet"))->from("articles")->join("article_data")->on("articles.id","=","article_data.article_id")->join("routes")->on("article_data.route_id","=","routes.id")->where("routes.zobrazit","=",1)->where("routes.language_id","=",$language_id)->execute()->get("pocet");   
    }
    
    /**
     * Nacte sadu clanku podle kategorie a jazykove verze
     * @param type $language_id
     * @return boolean 
     */
    public static function get_article_list($language_id,$category=0,$limit=100,$offset=0,$homepage=false)
    {
        $articles=orm::factory("article")
                ->join("routes")->on("article_data.route_id","=","routes.id")
                ->where("language_id","=",$language_id)
                //->where("article_category_id","=",db::expr($category))
                ->where("zobrazit","=",1)
                ->order_by(self::$order_by,self::$order_direction)
                ->limit($limit)
                ->offset($offset)
                ->find_all();
        
        $result_data=array();
        foreach ($articles as $article)
        {
            $result_data[$article->id]=$article->as_array();
            $result_data[$article->id]["nazev_seo"]=$article->route->nazev_seo;
            
            $filename=self::$photos_resources_dir.self::$navigation_module."/item/".self::$photos_resources_subdir."images-".$article->id."/".$article->photo_src."-t3.jpg";
            if(file_exists(str_replace('\\', '/',DOCROOT).$filename))
            {
                $result_data[$article->id]["photo"]=url::base().$filename;
            }
            else
            {
                $result_data[$article->id]["photo"]=false;
            }
            
        }

        return $result_data;
    }
    
    /**
     * Nacte sadu clanku podle kategorie a jazykove verze
     * @param type $language_id
     * @param type $category
     * @return boolean 
     */
    public static function get_article_banner_list($language_id=0, $limit=2)
    {
        $articles=orm::factory("article")
                ->join("routes")->on("routes.id", "=", "article_data.route_id")
                ->where("routes.zobrazit","=",1)
                ->language($language_id)
                ->order_by(self::$order_by,self::$order_direction)
                ->limit($limit)
                ->find_all();
        
        $result_data=array();
        foreach ($articles as $article)
        {
            $result_data[$article->id]=$article->as_array();
            $result_data[$article->id]["nazev_seo"]=$article->route->nazev_seo;
            
            $filename=self::$photos_resources_dir.self::$navigation_module."/item/".self::$photos_resources_subdir."images-".$article->id."/".$article->photo_src."-t1.jpg";
            if(file_exists(str_replace('\\', '/',DOCROOT).$filename))
            {
                $result_data[$article->id]["photo"]=url::base().$filename;
            }
            else
            {
                $result_data[$article->id]["photo"]=false;
            }
            
        }
        //die(print_r($result_data));
        return $result_data;
    }  
  
}
?>

