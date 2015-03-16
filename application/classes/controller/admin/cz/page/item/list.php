<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace stranek - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Cz_Page_Item_List extends Controller_Hana_List
{
    protected $page_category_id=3;
    
    public function before() {
        $this->orm=new Model_Page();
         $this->orm->page_category_id=$this->page_category_id;
        parent::before();
    }


    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(50)->set();
        $this->auto_list_table->column("controller")->label("Typ stránek")->data_src(array("related_table_1"=>"route","related_table_2"=>"module","column_name"=>"nazev"))->css_class("txtLeft")->sequenceable()->filterable()->width(150)->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit,"orm_tree_level_indicator"=>true))->css_class("txtLeft")->filterable()->sequenceable()->width(250)->set();
        $this->auto_list_table->column("popis")->label("Popis")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        $this->auto_list_table->column("fotogalerie")->type("relatedDetail")->label("Galerie")->data_src(array("db_query"=>db::select(array(db::expr("count(id)"),"count"))->from(strtolower($this->orm->class_name)."_photos"),"db_query_where_colid"=>"page_id"))->item_settings(array("hrefid"=>$this->base_path_to_gallery,"alt"=>"editovat fotogalerii","alt_empty"=>"vložit nové fotky do fotogalerie","image"=>"images.png","image_empty"=>"images_empty.png"))->width(40)->exportable(false)->set();
        //$this->auto_list_table->column("slideshow")->type("relatedDetail")->label("Prezentace")->data_src(array("db_query"=>db::select(array(db::expr("count(id)"),"count"))->from(strtolower($this->orm->class_name)."_slideshows"),"db_query_where_colid"=>"page_id"))->item_settings(array("hrefid"=>$this->base_path_to_slideshow,"alt"=>"editovat prezentaci","alt_empty"=>"vložit nové fotky do prezentace","image"=>"images.png","image_empty"=>"images_empty.png"))->width(40)->exportable(false)->set();
        if(Kohana::config("languages")->get("enabled"))
        $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(60)->set();
        $this->auto_list_table->column("poradi")->type("changeOrderShifts")->label("")->item_settings(array("restriction"=>array("name"=>"page_category_id","value"=>$this->page_category_id)))->sequenceable()->width(32)->exportable(false)->printable(false)->set();
        $this->auto_list_table->column("zobrazit")->type("switch")->data_src(array("related_table_1"=>"route"))->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->item_settings(array("readonly"=>"route"))->width(30)->exportable(false)->printable(false)->set();
    }

    protected function _orm_setup()
    {
        $this->orm->where("page_category_id","=",$this->page_category_id);
        $this->orm->join("routes")->on("page_data.route_id","=","routes.id");
        $this->orm->join("modules")->on("routes.module_id","=","modules.id");
        $this->orm->select(array("modules.nazev","controller"));
//            

    }
    
    protected function _form_action_change_order($data)
    {
        $this->module_service->reorder_two_items($data["item_id"], $data["direction"],false, false, "page_category_id");
        $this->data_saved=true;
    }
    
    protected function _action_router($data)
    {
        // po uprave struktury stranek smazu kazdopadne cache a to pro vsecky jazyky (mohla byt zmena poradi ci jine spolecne veci)
        Hana_Navigation::instance()->delete_navigation_cache($this->page_category_id);
        
        return parent::_action_router($data);
    }
    
    

    

}
?>