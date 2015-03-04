<?php defined('SYSPATH') or die('No direct script access.');
 /**
 * Administrace stranek - seznam.
 *
 * @package    Hana/AutoForm
 * @author     Pavel Herink
 * @copyright  (c) 2012 Pavel Herink
 */

class Controller_Admin_Cz_Page_System_List extends Controller_Hana_List
{
    protected $page_category_id=1;
    protected $order_mode=false;
    
    public function before() {
        $this->orm=new Model_Page();
        $this->orm->page_category_id=$this->page_category_id;
        parent::before();
        $this->tree_mode=false;
    }


    protected function _column_definitions()
    {
        $this->auto_list_table->column("id")->label("# ID")->width(30)->set();
        $this->auto_list_table->column("nazev")->type("link")->label("Název")->item_settings(array("hrefid"=>$this->base_path_to_edit,"orm_tree_level_indicator"=>true))->css_class("txtLeft")->filterable()->sequenceable()->width(200)->set();
        $this->auto_list_table->column("nazev_seo")->label("Název_seo")->data_src(array("related_table_1"=>"route","column_name"=>"nazev_seo"))->css_class("txtLeft")->sequenceable()->filterable(array("type"=>"edit"))->width(180)->set();
        
        $this->auto_list_table->column("controller")->label("Typ stránek")->data_src(array("related_table_1"=>"route","related_table_2"=>"module","column_name"=>"nazev"))->css_class("txtLeft")->sequenceable()->filterable()->width(120)->set();
        $this->auto_list_table->column("action")->label("Akce")->data_src(array("related_table_1"=>"route","column_name"=>"module_action"))->css_class("txtLeft")->sequenceable()->filterable(array("type"=>"edit"))->width(120)->set();
        $this->auto_list_table->column("param_id1")->label("1. Parametr akce")->data_src(array("related_table_1"=>"route","column_name"=>"param_id1"))->css_class("txtLeft")->sequenceable()->filterable(array("type"=>"edit"))->width(150)->set();
        
        
        $this->auto_list_table->column("popis")->label("Popis")->css_class("txtLeft")->item_settings(array("maxlenght"=>100))->filterable()->set();
        $this->auto_list_table->column("available_languages")->type("languages")->item_settings(array("hrefid"=>$this->base_path_to_edit))->width(60)->set();
        $this->auto_list_table->column("zobrazit")->type("switch")->data_src(array("related_table_1"=>"route"))->item_settings(array("action"=>"change_visibility","states"=>array(0=>array("image"=>"lightbulb_off.png","label"=>"neaktivní"),1=>array("image"=>"lightbulb.png","label"=>"aktivní"))))->sequenceable()->filterable(array("col_name"=>"routes.zobrazit"))->label("")->width(32)->set();
        $this->auto_list_table->column("delete")->type("checkbox")->value(0)->label("")->item_settings(array("readonly"=>"route"))->width(30)->exportable(false)->printable(false)->set();
    }

    protected function _orm_setup()
    {
        $this->orm->where("page_category_id","=",$this->page_category_id);
        $this->orm->join("routes")->on("page_data.route_id","=","routes.id");
        $this->orm->join("modules")->on("routes.module_id","=","modules.id");
        $this->orm->select(array("routes.module_action","action"))->select(array("modules.nazev","controller"))->select(array("routes.param_id1","param_id1"));

//            

    } 

}
?>