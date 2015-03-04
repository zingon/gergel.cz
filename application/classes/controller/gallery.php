<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Obecna pripojitelna galerie - widget.
 * 
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */
class Controller_Gallery extends Controller
{


    public function action_index()
    {
        $template = new View("gallery_list");

        $template->items = Service_Gallery::get_realizace_galleries();
        $template->item = Service_Page::get_page_by_route_id($this->application_context->get_actual_route());
        $this->request->response = $template->render();
    }

    public function action_detail()
    {
        $template = new View("gallery_detail");
        $item = Service_Gallery::get_gallery_by_route_id($this->application_context->get_actual_route());
        $photos = Service_Gallery::get_photos($item);
        $item_array = $item->as_array();
        $item_array["nazev_seo"] = $this->application_context->get_actual_seo();

        $template->item = $item_array;
        $template->items = $photos;
        $this->request->response = $template->render();
    }

    public function action_default_widget($seo, $settings="t1-t2")
    {
        $gallery=new View("gallery/plain");
        $gallery->photos=$this->_core_functionality($settings);
        $gallery->module=$this->application_context->get_main_controller();
        $this->request->response=$gallery->render();
    }
    
    public function action_slider_widget($seo, $settings="t1-t2")
    {
       $gallery=new View("gallery_slider");
       $gallery->photos=$this->_core_functionality($settings);
       $gallery->module=$this->application_context->get_main_controller();
       $this->request->response=$gallery->render();
    }
    
    public function action_custom_widget($seo, $settings="t1-t2")
    {
       $gallery=new View("gallery_with_thumbnails");
       $gallery->photos=$this->_core_functionality($settings);
       $gallery->module=$this->application_context->get_main_controller();
       $this->request->response=$gallery->render();
    }
    
    public function action_carousel_widget()
    {
       $gallery=new View("gallery_simple_carousel");
       $gallery->photos=$this->_core_functionality("t1-t1");
       $gallery->module=$this->application_context->get_main_controller();
       $this->request->response=$gallery->render();
    }
    
    
    
    private function _core_functionality($settings="t1-t2", $special_no="", $module="")
    {
        
        if(!$module) $module = $this->application_context->get_main_controller();
        if($module=="catalog") $module_db="product"; else $module_db=$module;
            

 
        $route_id = $this->application_context->get_route_id();

        $suffixes=explode("-", $settings);
        $detail_suffix=$suffixes[0];
        $thumbnail_suffix=$suffixes[1];
        
        // specialni id
        if(isset($suffixes[2]))
        {
            $id=$suffixes[2];
        }
        else
        {
            // automaticky z routy
            $id=DB::select(array($module_db."_data.".$module_db."_id","id"))->from($module_db."_data")->where("route_id","=",$route_id)->execute()->get('id');
        }
        
        $photos=orm::factory($module_db."_p".$special_no."hoto")->where($module_db."_id","=",$id)->where("zobrazit","=",1)->order_by("poradi","asc")->find_all();;
        
        $photodir="media/photos/".$module."/item/gallery".$special_no."/images-".$id."/";


        $photos_array=array();

        foreach($photos as $photo)
        {

            if($photo->photo_src && file_exists(str_replace('\\', '/',DOCROOT).$photodir.$photo->photo_src."-".$detail_suffix.".jpg"))
            {
                $photos_array[$photo->poradi]=$photo->as_array();
                $photos_array[$photo->poradi]["photo"]=url::base().$photodir.$photo->photo_src."-".$thumbnail_suffix.".jpg";
                $photos_array[$photo->poradi]["photo_detail"]=url::base().$photodir.$photo->photo_src."-".$detail_suffix.".jpg";
                $photos_array[$photo->poradi]["nazev"]=$photo->nazev;
                $photos_array[$photo->poradi]["gallery_id"]=$id;
            }
        }

        return($photos_array);

    }
    
  
}

?>
